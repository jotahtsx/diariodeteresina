<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;

class EventSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Eventos Ao Vivo';
    protected static ?string $title = 'Central de Eventos';
    protected static string $view = 'filament.pages.event-settings';

    // Importante: Manter o estado dos dados sincronizado
    public ?array $data = [];

    public function mount(): void
    {
        // Preenche o formulário com o que já está salvo no Cache
        $this->form->fill([
            'has_live_games' => Cache::get('has_live_games', false),
            'has_live_fights' => Cache::get('has_live_fights', false),
        ]);
    }

    /**
     * Este método monitora mudanças no array $data em tempo real.
     * Sempre que um Toggle mudar, ele salva no Cache imediatamente.
     */
    public function updatedData($value, $key): void
    {
        // O $key vem no formato "has_live_games"
        Cache::forever($key, $value);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Destaques da Home')
                    ->description('Ligue ou desligue os banners globais de eventos')
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('has_live_games')
                                ->label('Jogos Ao Vivo (Verde)')
                                ->onColor('success')
                                ->live() // Faz a requisição Livewire ao clicar
                                ->afterStateUpdated(fn ($state) => Cache::forever('has_live_games', $state)),

                            Toggle::make('has_live_fights')
                                ->label('Lutas Ao Vivo (Vermelho)')
                                ->onColor('danger')
                                ->disabled() // Mantido simbólico por enquanto
                                ->live()
                                ->afterStateUpdated(fn ($state) => Cache::forever('has_live_fights', $state)),
                        ]),
                    ]),
            ])->statePath('data');
    }
}
