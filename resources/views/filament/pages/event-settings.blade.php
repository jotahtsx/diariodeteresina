<x-filament-panels::page>
    <form wire:submit.prevent="save">

        {{-- Card do Formulário --}}
        <div
            class="fi-section rounded-xl border border-gray-200 bg-white p-8 shadow-sm dark:border-white/10 dark:bg-gray-900">
            {{ $this->form }}
        </div>

        @php
            $isFight = $data['has_live_fights'] ?? false;
            $isGame = $data['has_live_games'] ?? false;

            // Lógica de cores: Vermelho, Verde ou Cinza se nada estiver marcado
            if ($isFight) {
                $bgStyle = 'background-color: #c0392b;'; // Vermelho Luta
            } elseif ($isGame) {
                $bgStyle = 'background-color: #27ae60;'; // Verde Futebol
            } else {
                $bgStyle = 'background-color: #94a3b8;'; // Cinza Neutro (Slate 400)
            }
        @endphp

        {{-- Container com o espaçamento de 40px garantido --}}
        <div class="flex justify-start" style="padding-top: 40px;">
            <button type="submit" style="{{ $bgStyle }}; min-width: 200px;"
                class="relative inline-flex items-center justify-center px-8 py-4 text-[13px] font-black uppercase tracking-[0.15em] text-white transition-all duration-300 ease-in-out rounded-xl shadow-xl hover:brightness-110 active:scale-95">

                <span wire:loading.remove wire:target="save">
                    Publicar Alterações
                </span>

                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Salvando
                </span>
            </button>
        </div>
    </form>
</x-filament-panels::page>
