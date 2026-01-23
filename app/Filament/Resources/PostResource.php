<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Notícias';
    protected static ?string $modelLabel = 'Notícia';
    protected static ?string $pluralModelLabel = 'Notícias';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Coluna Larga (Conteúdo Principal)
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Conteúdo da Matéria')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Título da Notícia')
                                    ->required()
                                    ->columnSpanFull()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn (string $operation, $state, Forms\Set $set) =>
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),

                                Forms\Components\TextInput::make('slug')
                                    ->label('URL Amigável')
                                    ->required()
                                    ->columnSpanFull()
                                    ->unique(Post::class, 'slug', ignoreRecord: true),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Resumo (Chamada)')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Forms\Components\RichEditor::make('content')
                                    ->label('Corpo da Notícia')
                                    ->required()
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock',
                                        'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'undo',
                                    ]),
                            ]),

                        Forms\Components\Section::make('Integrações e Redes Sociais')
                            ->schema([
                                Forms\Components\TextInput::make('instagram_url')
                                    ->label('Link do Instagram')
                                    ->url()
                                    ->prefix('https://'),

                                Forms\Components\TextInput::make('telegram_message_id')
                                    ->label('ID Mensagem Telegram')
                                    ->numeric(),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),

                // Coluna Estreita (Metadados e Imagem)
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Publicação')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'draft' => 'Rascunho',
                                        'published' => 'Publicado',
                                        'archived' => 'Arquivado',
                                    ])
                                    ->default('draft')
                                    ->required()
                                    ->native(false),

                                Forms\Components\Select::make('author_id')
                                    ->label('Autor')
                                    ->relationship('author', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Forms\Components\Select::make('category_id')
                                    ->label('Categoria')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->preload(),

                                Forms\Components\Select::make('city_id')
                                    ->label('Cidade')
                                    ->relationship('city', 'name')
                                    ->preload()
                                    ->searchable(),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Destaque na Home')
                                    ->inline(false),
                            ]),

                        Forms\Components\Section::make('Mídia')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Capa da Notícia')
                                    ->image()
                                    ->directory('posts')
                                    ->imageEditor()
                                    ->required(),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Capa'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->limit(40)
                    ->wrap(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoria')
                    ->badge()
                    ->color(fn ($record) => $record->category->color ?? 'gray'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'archived' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('views')
                    ->label('Visitas')
                    ->numeric()
                    ->sortable()
                    ->badge(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Destaque')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Rascunho',
                        'published' => 'Publicado',
                        'archived' => 'Arquivado',
                    ]),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
