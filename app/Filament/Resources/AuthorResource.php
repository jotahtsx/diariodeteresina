<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Autores';
    protected static ?string $modelLabel = 'Autor';
    protected static ?string $pluralModelLabel = 'Autores';
    protected static ?int $navigationSort = 3;
    protected static ?string $slug = 'autores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Perfil do Autor')
                    ->description('Gerencie as informações públicas do repórter ou colunista.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome Completo')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('avatar')
                            ->label('Foto de Perfil')
                            ->image()
                            ->directory('authors')
                            ->visibility('public')

                            // Preview limpo
                            ->imagePreviewHeight(250)
                            ->panelAspectRatio('1:1')
                            ->panelLayout('compact')

                            // Remove nome do arquivo (.jpg, .png etc)
                            ->showUploadedFileName(false)

                            // Ações
                            ->deletable(true)
                            ->openable()
                            ->downloadable()
                            ->imageEditor()

                            ->helperText(
                                'Para trocar a imagem: clique no X. 
                                 Para editar: use o lápis. 
                                 Para baixar: use o ícone de seta.'
                            ),

                        Forms\Components\TextInput::make('city')
                            ->label('Cidade'),

                        Forms\Components\TextInput::make('state')
                            ->label('Estado'),

                        Forms\Components\RichEditor::make('bio')
                            ->label('Biografia')
                            ->columnSpanFull()
                            ->toolbarButtons(['bold', 'italic', 'link']),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('Cidade/UF')
                    ->state(
                        fn (Author $record) =>
                        $record->city && $record->state
                            ? "{$record->city} - {$record->state}"
                            : 'Não informada'
                    )
                    ->color('gray'),

                Tables\Columns\TextColumn::make('posts_count')
                    ->label('Notícias')
                    ->counts('posts')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Cadastrado em')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                // 🔥 DELETE TOTAL — banco + model resolvem
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
