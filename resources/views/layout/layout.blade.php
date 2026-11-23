<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - ParkirKu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('styles')
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

<div class="min-h-screen flex bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.16),_transparent_30%),radial-gradient(circle_at_bottom_right,_rgba(15,118,110,0.14),_transparent_25%)]">

    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950/95 text-white
               shadow-2xl shadow-slate-900/40 transform -translate-x-full lg:translate-x-0
               transition-transform duration-300 backdrop-blur-sm">

        {{-- LOGO --}}
        <div class="flex h-20 items-center border-b border-white/10 px-5">

            <div class="mr-3 flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 shadow-lg shadow-blue-500/30">

                <i data-lucide="car" class="h-5 w-5"></i>

            </div>

            <div>
                <h1 class="text-lg font-bold tracking-tight">
                    ParkirKu
                </h1>

                <p class="text-[11px] text-slate-300">
                    Sistem Informasi Parkir
                </p>
            </div>

        </div>


        {{-- =================================================
             MENU
        ================================================== --}}

        <nav class="h-[calc(100vh-180px)] space-y-2 overflow-y-auto p-4">

            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">
                Main Menu
            </p>


            {{-- =================================================
                 DASHBOARD SEMUA ROLE
            ================================================== --}}

            @if(auth()->user()->role === 'admin')

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl border border-transparent px-3 py-3 transition {{ request()->routeIs('admin.dashboard')
                        ? 'border-blue-500/30 bg-blue-500/10 text-white shadow-inner shadow-blue-500/10'
                        : 'text-slate-300 hover:border-white/10 hover:bg-white/5 hover:text-white' }}">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/5">
                        <i data-lucide="layout-dashboard" class="h-4 w-4"></i>
                    </span>

                    <span class="font-medium">Dashboard</span>

                </a>

            @elseif(auth()->user()->role === 'petugas')

                <a href="{{ route('petugas.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl border border-transparent px-3 py-3 transition {{ request()->routeIs('petugas.dashboard')
                        ? 'border-blue-500/30 bg-blue-500/10 text-white shadow-inner shadow-blue-500/10'
                        : 'text-slate-300 hover:border-white/10 hover:bg-white/5 hover:text-white' }}">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/5">
                        <i data-lucide="layout-dashboard" class="h-4 w-4"></i>
                    </span>

                    <span class="font-medium">Dashboard</span>

                </a>

            @elseif(auth()->user()->role === 'owner')

                <a href="{{ route('owner.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl border border-transparent px-3 py-3 transition {{ request()->routeIs('owner.dashboard')
                        ? 'border-blue-500/30 bg-blue-500/10 text-white shadow-inner shadow-blue-500/10'
                        : 'text-slate-300 hover:border-white/10 hover:bg-white/5 hover:text-white' }}">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/5">
                        <i data-lucide="layout-dashboard" class="h-4 w-4"></i>
                    </span>

                    <span class="font-medium">Dashboard</span>

                </a>

            @endif


            {{-- =================================================
                 MENU ADMIN
            ================================================== --}}

            @if(auth()->user()->role === 'admin')

                <div class="pt-5">

                    <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">
                        Parkir
                    </p>

                    <a href="{{ route('admin.kendaraan.index') }}"
                     class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-sky-500/10 text-sky-300">
                            <i data-lucide="car-front" class="h-4 w-4"></i>
                        </span>
                        <span>Kendaraan</span>
                    </a>

                    <a href="{{ route('admin.transaksi.index') }}"
                     class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-300">
                            <i data-lucide="receipt" class="h-4 w-4"></i>
                        </span>
                        <span>Transaksi Parkir</span>
                    </a>

                    <a href="{{ route('admin.area-parkir.index') }}" 
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-violet-500/10 text-violet-300">
                            <i data-lucide="map-pin" class="h-4 w-4"></i>
                        </span>
                        <span>Area Parkir</span>
                    </a>

                    <a href="{{ route('admin.tarif-parkir.index') }}"
                     class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-500/10 text-amber-300">
                            <i data-lucide="banknote" class="h-4 w-4"></i>
                        </span>
                        <span>Tarif Parkir</span>
                    </a>

                </div>


                {{-- MANAGEMENT --}}

                <div class="pt-5">

                    <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">
                        Management
                    </p>

                    <a href="{{ route('admin.user.index') }}" 
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-pink-500/10 text-pink-300">
                            <i data-lucide="users" class="h-4 w-4"></i>
                        </span>
                        <span>Data User</span>
                    </a>

                    <a href="{{ route('admin.log-aktivitas.index') }}"
                     class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-500/10 text-rose-300">
                            <i data-lucide="activity" class="h-4 w-4"></i>
                        </span>
                        <span>Log Aktivitas</span>
                    </a>

                </div>

            @endif


            {{-- =================================================
                 MENU PETUGAS
            ================================================== --}}

            @if(auth()->user()->role === 'petugas')

                <div class="pt-5">

                    <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">
                        Operasional
                    </p>

                    <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-sky-500/10 text-sky-300">
                            <i data-lucide="car-front" class="h-4 w-4"></i>
                        </span>
                        <span>Kendaraan</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-300">
                            <i data-lucide="receipt" class="h-4 w-4"></i>
                        </span>
                        <span>Transaksi Parkir</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-violet-500/10 text-violet-300">
                            <i data-lucide="printer" class="h-4 w-4"></i>
                        </span>
                        <span>Cetak Struk</span>
                    </a>

                </div>

            @endif


            {{-- =================================================
                 MENU OWNER
            ================================================== --}}

            @if(auth()->user()->role === 'owner')

                <div class="pt-5">

                    <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">
                        Laporan
                    </p>

                    <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-300">
                            <i data-lucide="receipt" class="h-4 w-4"></i>
                        </span>
                        <span>Transaksi</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/10 text-blue-300">
                            <i data-lucide="chart-column" class="h-4 w-4"></i>
                        </span>
                        <span>Rekap Transaksi</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500/10 text-orange-300">
                            <i data-lucide="file-text" class="h-4 w-4"></i>
                        </span>
                        <span>Laporan</span>
                    </a>

                </div>

            @endif


            
        </nav>


        {{-- =====================================================
             USER SIDEBAR
        ====================================================== --}}


        
        <div class="absolute bottom-0 left-0 right-0 border-t border-white/10 bg-slate-950/90 p-4">

            <div class="rounded-2xl border border-white/10 bg-white/5 p-3 shadow-lg shadow-slate-950/20">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 text-white shadow-lg shadow-blue-500/30">

                        <i data-lucide="user" class="h-5 w-5"></i>

                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-white">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="capitalize text-xs text-slate-300">
                            {{ auth()->user()->role }}
                        </p>

                    </div>

                </div>

            </div>
<form method="POST" action="{{ route('logout') }}" class="px-4 pb-3">
    @csrf
    <button type="submit"
        class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-red-500/15 hover:text-red-300">
        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-500/10 text-red-300">
            <i data-lucide="log-out" class="h-4 w-4"></i>
        </span>
        Keluar
    </button>
</form>
        </div>

    </aside>


    {{-- =====================================================
         OVERLAY MOBILE
    ====================================================== --}}

    <div id="sidebarOverlay"
        class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden">
    </div>


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <div class="flex-1 lg:ml-64 min-w-0">


        {{-- =================================================
             HEADER
        ================================================== --}}

        <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-200 bg-white/80 px-4 backdrop-blur-xl sm:px-6">


            {{-- MOBILE MENU --}}

            <button id="sidebarButton"
                class="rounded-xl border border-slate-200 bg-slate-50 p-2.5 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600 lg:hidden">

                <i data-lucide="menu" class="h-5 w-5"></i>

            </button>

            <div class="hidden lg:block">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 text-white shadow-lg shadow-blue-500/25">
                        <i data-lucide="shield-check" class="h-4 w-4"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.2em] text-slate-400">ParkirKu</p>
                        <h2 class="text-lg font-semibold text-slate-800">@yield('page-title', 'Dashboard')</h2>
                    </div>
                </div>
            </div>

            <div class="ml-auto flex items-center gap-3">
               <div class="relative">
    <button id="bell-btn" type="button" class="relative flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white">
        <i data-lucide="bell" class="h-5 w-5 text-slate-600"></i>
        <span class="absolute right-2 top-2 h-2.5 w-2.5 rounded-full bg-red-500"></span>
    </button>

    <div id="bell-menu" class="absolute right-0 z-[100] mt-2 hidden w-80 rounded-xl border border-slate-200 bg-white shadow-xl">
        <div class="border-b border-slate-100 px-4 py-3 text-sm font-semibold text-slate-800">
            Aktivitas Terbaru
        </div>
        @php
            $notif = \Illuminate\Support\Facades\DB::table('tb_log_aktivitas')
                ->orderByDesc('id_log')->limit(5)->get();
        @endphp
        @forelse ($notif as $n)
            <div class="border-b border-slate-50 px-4 py-3 text-sm text-slate-700">
                {{ $n->aktivitas }}
                <div class="text-xs text-slate-400">{{ $n->waktu_aktivitas }}</div>
            </div>
        @empty
            <div class="px-4 py-6 text-center text-sm text-slate-400">Belum ada aktivitas.</div>
        @endforelse
    </div>

</div>

                <div class="flex items-center gap-3 border-l border-slate-200 pl-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 text-white shadow-lg shadow-blue-500/25">
                        <i data-lucide="user" class="h-5 w-5"></i>
                    </div>

                    <div class="hidden sm:block">
                        <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs capitalize text-slate-500">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>

        </header>


        {{-- =================================================
             CONTENT
        ================================================== --}}

        <main class="p-4 sm:p-6">

            @yield('content')

        </main>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <footer class="border-t border-slate-200 bg-white/80 px-6 py-4 backdrop-blur-xl">

            <div class="flex flex-col items-center justify-between gap-2 sm:flex-row">

                <p class="text-sm text-slate-500">
                    © {{ date('Y') }} ParkirKu. All rights reserved.
                </p>

                <p class="text-sm text-slate-400">
                    Sistem Informasi Parkir
                </p>

            </div>

        </footer>

    </div>

</div>


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        lucide.createIcons();


        const sidebar =
            document.getElementById('sidebar');

        const sidebarButton =
            document.getElementById('sidebarButton');

        const sidebarOverlay =
            document.getElementById('sidebarOverlay');


        sidebarButton?.addEventListener('click', function () {

            sidebar.classList.remove('-translate-x-full');

            sidebarOverlay.classList.remove('hidden');

        });


        sidebarOverlay?.addEventListener('click', function () {

            sidebar.classList.add('-translate-x-full');

            sidebarOverlay.classList.add('hidden');

        });

    });

</script>


@stack('scripts')

<script>
    const bellBtn = document.getElementById('bell-btn');
    const bellMenu = document.getElementById('bell-menu');

    bellBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        bellMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', () => bellMenu.classList.add('hidden'));
</script>

</body>
</html>