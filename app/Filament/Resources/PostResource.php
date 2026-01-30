<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Author;
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
                // BLOCO 1: Identidade e SEO
                Forms\Components\Section::make('Informações Básicas')
                    ->description('Título, tag visual e link da notícia')
                    ->schema([
                        // NOVO: Eyebrow com o estilo solicitado
                        Forms\Components\TextInput::make('eyebrow')
                            ->label('Tag de Chamada (Eyebrow)')
                            ->placeholder('Ex: URGENTE, EXCLUSIVO')
                            ->maxLength(30)
                            ->extraInputAttributes([
                                'class' => 'rounded-xl border-gray-200 shadow-sm font-bold text-[#2c3e50] uppercase tracking-wider',
                            ]),

                        Forms\Components\TextInput::make('title')
                            ->label('Título da Notícia')
                            ->required()
                            ->live(onBlur: true)
                            ->extraInputAttributes([
                                'class' => 'rounded-xl border-gray-200 shadow-sm text-lg font-medium',
                            ])
                            ->afterStateUpdated(fn ($operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        Forms\Components\TextInput::make('slug')
                            ->label('URL Amigável')
                            ->required()
                            ->unique(Post::class, 'slug', ignoreRecord: true)
                            ->extraInputAttributes(['class' => 'rounded-xl bg-gray-50 border-gray-100 text-xs text-gray-400']),

                        Forms\Components\Textarea::make('excerpt')
                            ->label('Resumo da Matéria')
                            ->rows(2)
                            ->extraInputAttributes(['class' => 'rounded-xl border-gray-200 shadow-sm']),
                    ])->columns(1),

                // BLOCO 2: Editor
                Forms\Components\Section::make('Conteúdo')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Corpo da Notícia')
                            ->required()
                            ->extraAttributes(['class' => 'rounded-xl border-gray-200 shadow-sm overflow-hidden']),
                    ]),

                // BLOCO 3: Imagem
                Forms\Components\Section::make('Capa')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagem Principal')
                            ->image()
                            ->imageEditor()
                            ->extraAttributes(['class' => 'rounded-2xl border-gray-200 shadow-sm overflow-hidden'])
                            ->required(),
                    ]),

                // BLOCO 4: Metadados
                Forms\Components\Section::make('Configurações e Localização')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options(['draft' => 'Rascunho', 'published' => 'Publicado'])
                            ->native(false)
                            ->required(),

                        Forms\Components\Select::make('author_id')
                            ->label('Autor')
                            ->options(Author::pluck('name', 'id'))
                            ->searchable()
                            ->native(false)
                            ->required(),

                        Forms\Components\Select::make('category_id')
                            ->label('Categoria')
                            ->relationship('category', 'name')
                            ->preload()
                            ->native(false)
                            ->required(),

                        Forms\Components\Select::make('state_id')
                            ->label('Estado')
                            ->options(\App\Models\State::pluck('name', 'id'))
                            ->reactive()
                            ->native(false)
                            ->required(),

                        Forms\Components\Select::make('city_id')
                            ->label('Cidade')
                            ->options(fn (Forms\Get $get) => \App\Models\City::where('state_id', $get('state_id'))->pluck('name', 'id'))
                            ->searchable()
                            ->live()
                            ->native(false)
                            ->required(),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Destaque na Home')
                            ->onColor('success')
                            ->inline(false),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular(),
                Tables\Columns\TextColumn::make('title')->searchable()->wrap(),
                // Adicionada a tag na tabela para você ver sem precisar abrir o post
                Tables\Columns\TextColumn::make('eyebrow')
                    ->label('Tag')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('status')->badge(),
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
