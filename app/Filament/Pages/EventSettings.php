<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
// Importante
use Filament\Pages\Page; // Para o feedback visual
use Illuminate\Support\Facades\Cache;

class EventSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Eventos Ao Vivo';
    protected static ?string $title = 'Central de Eventos';
    protected static string $view = 'filament.pages.event-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'has_live_games' => Cache::get('has_live_games', false),
            'has_live_fights' => Cache::get('has_live_fights', false),
            'fight_title' => Cache::get('fight_title', ''),
        ]);
    }

    // Botão de Salvar no topo/rodapé da página
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Salvar Alterações')
                ->submit('save') // Chama o método save()
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        // Obtém os dados validados do formulário
        $state = $this->form->getState();

        // Salva os Toggles (esses sempre existem)
        Cache::forever('has_live_games', $state['has_live_games'] ?? false);
        Cache::forever('has_live_fights', $state['has_live_fights'] ?? false);

        // SALVA O TÍTULO (Aqui está o segredo: se não existir no state, salva string vazia)
        Cache::forever('fight_title', $state['fight_title'] ?? '');

        \Filament\Notifications\Notification::make()
            ->title('Configurações atualizadas!')
            ->success()
            ->send();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Destaques da Home')
                    ->description('Escolha qual banner exibir. Ao ativar um, o outro será desativado.')
                    ->schema([
                        \Filament\Forms\Components\Grid::make(2)->schema([
                            \Filament\Forms\Components\Toggle::make('has_live_games')
                                ->label('Jogos Ao Vivo (Verde)')
                                ->onColor('success')
                                ->live()
                                ->afterStateUpdated(fn ($state, \Filament\Forms\Set $set) => $state ? $set('has_live_fights', false) : null),

                            \Filament\Forms\Components\Toggle::make('has_live_fights')
                                ->label('Lutas Ao Vivo (Vermelho)')
                                ->onColor('danger')
                                ->live()
                                ->afterStateUpdated(fn ($state, \Filament\Forms\Set $set) => $state ? $set('has_live_games', false) : null),

                            \Filament\Forms\Components\TextInput::make('fight_title')
                                ->label('Título do Evento de Luta')
                                ->placeholder('Ex: UFC 300 - Do Bronx vs Makhachev')
                                ->columnSpanFull()
                                ->hidden(fn (\Filament\Forms\Get $get) => ! $get('has_live_fights'))
                                ->live()
                                ->afterStateUpdated(fn ($state) => Cache::forever('fight_title', $state)),
                            ]),
                    ]),
            ])->statePath('data');
    }
}
