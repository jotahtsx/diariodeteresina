<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StateResource\Pages;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationLabel = 'Estados';
    protected static ?string $modelLabel = 'Estado';
    protected static ?string $pluralModelLabel = 'Estados';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações do Estado')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome do Estado')
                            ->required()
                            ->placeholder('Ex: Piauí'),

                        Forms\Components\TextInput::make('abbr')
                            ->label('Sigla (UF)')
                            ->required()
                            ->maxLength(2)
                            ->placeholder('Ex: PI'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Estado')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('abbr')
                    ->label('Sigla')
                    ->badge(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => \App\Filament\Resources\StateResource\Pages\CreateState::route('/create'),
            'edit' => \App\Filament\Resources\StateResource\Pages\EditState::route('/{record}/edit'),
        ];
    }
}
