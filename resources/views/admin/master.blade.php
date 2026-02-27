<!DOCTYPE html>
<html lang="pt-br" 
      x-data="{ adminDarkMode: localStorage.getItem('admin-theme') === 'dark' }" 
      x-init="$watch('adminDarkMode', val => {
          localStorage.setItem('admin-theme', val ? 'dark' : 'light');
          if (val) document.documentElement.classList.add('admin-dark');
          else document.documentElement.classList.remove('admin-dark');
      })"
      :class="{ 'admin-dark': adminDarkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel — Pebas 40º</title>
    
    {{-- Font Awesome para os ícones --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        if (localStorage.getItem('admin-theme') === 'dark') {
            document.documentElement.classList.add('admin-dark');
        } else {
            document.documentElement.classList.remove('admin-dark');
        }
    </script>
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="antialiased transition-colors duration-300">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-72 bg-white dark:bg-slate-900 border-r border-slate-100 dark:border-slate-800 flex flex-col sticky top-0 h-screen transition-colors">
			<div class="p-8">
				<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
					{{-- Texto Principal - Aumentado para 3xl --}}
					<h1 class="text-3xl font-[1000] tracking-tighter text-slate-900 dark:text-white transition-all duration-300 group-hover:tracking-tight">
						Pebas<span class="text-[#FFB800] drop-shadow-sm"> 40º</span>
					</h1>
				</a>
			</div>

            <nav class="flex-1 px-6 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-slate-900 dark:bg-portal-blue text-white font-bold text-sm">
                    <i class="fa-solid fa-chart-pie"></i>
                    Dashboard
                </a>
            </nav>
        </aside>

        <main class="flex-1">
            {{-- Header --}}
            <header class="h-20 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between px-10 sticky top-0 z-50">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Painel de Controle</span>
                
                <div class="flex items-center gap-6">
                    {{-- Botão de Tema (Ícone Puro) --}}
                    <button @click="adminDarkMode = !adminDarkMode" 
                            class="p-2 cursor-pointer focus:outline-none transition-all duration-300 hover:scale-110 text-slate-500 dark:text-yellow-400">
                        <i x-show="!adminDarkMode" class="fa-solid fa-moon text-xl animate-soft-entry"></i>
                        <i x-show="adminDarkMode" x-cloak class="fa-solid fa-sun text-xl animate-soft-entry"></i>
                    </button>

                    {{-- Info do Usuário com barra de separação mais escura --}}
                    <div class="flex items-center gap-3 pl-6 border-l-2 border-slate-200 dark:border-slate-800">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-[950] text-slate-900 dark:text-white leading-none tracking-tight">
                                {{ auth()->user()->name ?? 'Admin Pebas' }}
                            </p>
                            <p class="text-[10px] text-slate-500 dark:text-slate-400 font-bold mt-1 uppercase tracking-wider">
                                Administrador
                            </p>
                        </div>

                        {{-- Avatar Soft com borda reforçada --}}
                        <div class="w-10 h-10 rounded-2xl bg-slate-100 dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 overflow-hidden shadow-sm">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=1e40af&color=fff" alt="User">
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-10">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>