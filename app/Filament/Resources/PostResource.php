<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Author;
use App\Models\Post;
// ⚡ Adicionado
// ⚡ Adicionado
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

        Forms\Components\Section::make('Conteúdo da Matéria')

        ->schema([

        Forms\Components\TextInput::make('title')

        ->label('Título da Notícia')

        ->required()

        ->live(onBlur: true)

        ->afterStateUpdated(fn ($operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),



        Forms\Components\TextInput::make('slug')

        ->label('URL Amigável')

        ->required()

        ->unique(Post::class, 'slug', ignoreRecord: true),



        Forms\Components\Textarea::make('excerpt')

        ->label('Resumo (Chamada)')

        ->rows(3),



        Forms\Components\RichEditor::make('content')

        ->label('Corpo da Notícia')

        ->required(),

        ]),



        Forms\Components\Section::make('Publicação')

            ->schema([

            Forms\Components\Select::make('status')

            ->label('Status')

            ->options([

            'draft' => 'Rascunho',

            'published' => 'Publicado',

            'archived' => 'Arquivado',

            ])

            ->required(),



            Forms\Components\Select::make('author_id')

            ->label('Autor')

            ->options(Author::pluck('name', 'id'))

            ->required(),



        Forms\Components\Select::make('category_id')

            ->label('Categoria')

            ->relationship('category', 'name')

            ->preload()

            ->required(),

Forms\Components\Select::make('state_id')
    ->label('Estado')
    ->options(\App\Models\State::pluck('name', 'id'))
    ->reactive() // para atualizar a cidade quando o estado mudar
    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('city_id', null))
    ->required(),

Forms\Components\Select::make('city_id')
    ->label('Cidade')
    ->options(
        fn (Forms\Get $get) =>
        \App\Models\City::where('state_id', $get('state_id'))->pluck('name', 'id')
    )
    ->searchable()
    ->required(),

        Forms\Components\Toggle::make('is_featured')
            ->label('Destaque na Home'),
        ]),

        Forms\Components\Section::make('Mídia')

        ->schema([

        Forms\Components\FileUpload::make('image')

        ->label('Capa da Notícia')

        ->image()

        ->directory('posts')

        ->imagePreviewHeight(250)

        ->required(),

        ]),

        ]);

    }

    public static function table(Table $table): Table
    {

        return $table

        ->columns([

        Tables\Columns\ImageColumn::make('image')->label('Capa'),

        Tables\Columns\TextColumn::make('title')->label('Título')->searchable()->limit(40),

        Tables\Columns\TextColumn::make('author.name')->label('Autor')->sortable(),

        Tables\Columns\TextColumn::make('category.name')->label('Categoria')->badge(),

        Tables\Columns\TextColumn::make('status')

        ->label('Status')

        ->badge(),

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
