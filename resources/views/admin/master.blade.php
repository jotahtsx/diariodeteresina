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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        if (localStorage.getItem('admin-theme') === 'dark') {
            document.documentElement.classList.add('admin-dark');
        } else {
            document.documentElement.classList.remove('admin-dark');
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .admin-dark ::-webkit-scrollbar { width: 10px; background: #0f172a; }
        .admin-dark ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; border: 3px solid #0f172a; }
    </style>
</head>

{{-- MUDANÇA: bg-[#F1F5F9] no light dá o contraste que faltava --}}
<body class="antialiased transition-colors duration-300 bg-white dark:bg-[#0b1120]">
    <div class="flex min-h-screen">
        
        {{-- Sidebar --}}
        <aside class="w-72 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col sticky top-0 h-screen transition-colors z-[60]">
            <div class="p-8 pb-12">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col gap-0 group">
                    <h1 class="text-3xl font-[1000] tracking-tighter text-slate-900 dark:text-white leading-none">
                        Pebas<span class="text-[#FFB800]">40º</span>
                    </h1>
                    <span class="text-[9px] font-black uppercase tracking-[0.4em] text-portal-blue mt-1">Portal de Notícias</span>
                </a>
            </div>

            <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto">
                <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Principal</p>
                
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 dark:bg-portal-blue text-white shadow-lg' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} font-bold text-sm transition-all group">
                    <i class="fa-solid fa-chart-pie w-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-portal-blue' }}"></i>
                    Dashboard
                </a>

                <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mt-8 mb-4">Conteúdo</p>

                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-slate-900 dark:bg-portal-blue text-white shadow-lg' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} font-bold text-sm transition-all group">
                    <i class="fa-solid fa-tags w-5"></i>
                    Categorias
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 font-bold text-sm transition-all group">
                    <i class="fa-solid fa-file-lines w-5"></i>
                    Notícias
                </a>

                <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mt-8 mb-4">Administração</p>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 font-bold text-sm transition-all group">
                    <i class="fa-solid fa-users w-5"></i>
                    Usuários
                </a>
            </nav>

            <div class="p-4 mt-auto border-t border-slate-100 dark:border-slate-800">
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 font-black uppercase text-[10px] tracking-widest transition-all">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair do Sistema
                </a>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1">
            {{-- MUDANÇA: Removido /80 no light para o header ficar sólido branco --}}
            <header class="h-20 bg-white dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-10 sticky top-0 z-50">
                <div class="flex items-center gap-4">
                    <div class="h-6 w-[3px] bg-portal-blue rounded-full"></div>
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Ambiente de Gestão</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <button @click="adminDarkMode = !adminDarkMode" 
                            class="w-10 h-10 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-yellow-400 border border-slate-200 dark:border-slate-700 transition-all hover:scale-105">
                        <i x-show="!adminDarkMode" class="fa-solid fa-moon"></i>
                        <i x-show="adminDarkMode" x-cloak class="fa-solid fa-sun"></i>
                    </button>

                    <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 mx-2"></div>

                    <div class="flex items-center gap-4 group cursor-pointer">
                        <div class="text-right">
                            <p class="text-sm font-black text-slate-900 dark:text-white leading-none tracking-tight">
                                {{ auth()->user()->name ?? 'Admin Pebas' }}
                            </p>
                            <span class="text-[9px] text-portal-blue font-black uppercase tracking-widest">Master</span>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-slate-100 dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 overflow-hidden shadow-sm transition-transform group-hover:rotate-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=1e40af&color=fff" alt="User">
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-10 max-w-[1600px] mx-auto">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>