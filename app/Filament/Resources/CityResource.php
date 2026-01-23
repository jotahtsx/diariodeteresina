<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'Cidades';
    protected static ?string $modelLabel = 'Cidade';
    protected static ?string $pluralModelLabel = 'Cidades';

    // Isso garante que Cidades apareça logo abaixo de Estados (que é 1)
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações da Cidade')
                    ->description('Cadastre os dados da cidade para as notícias.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome da Cidade')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn (string $operation, $state, Forms\Set $set) =>
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                            ),

                        Forms\Components\TextInput::make('slug')
                            ->label('URL Amigável (Slug)')
                            ->required()
                            ->unique(City::class, 'slug', ignoreRecord: true),

                        Forms\Components\Select::make('state_id')
                            ->label('Estado')
                            ->relationship('state', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Cidade')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('state.name')
                    ->label('Estado')
                    ->badge()
                    ->color('info'), // Azul suave para destacar

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('state_id')
                    ->label('Filtrar por Estado')
                    ->relationship('state', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
