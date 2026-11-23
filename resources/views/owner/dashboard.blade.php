@extends('layout.layout')

@section('title', 'Dashboard Owner')

@section('page-title', 'Dashboard Owner')

@section('content')

<div class="space-y-6">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Dashboard Owner
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Selamat datang, {{ auth()->user()->name }}.
            Pantau aktivitas dan transaksi parkir dari sini.
        </p>
    </div>


    {{-- =====================================================
         STATISTIK
    ====================================================== --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total Transaksi --}}

        <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Total Transaksi
                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-slate-800">
                        0
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        Hari ini
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-blue-100 text-blue-600">

                    <i data-lucide="receipt" class="h-6 w-6"></i>

                </div>

            </div>

        </div>


        {{-- Pendapatan --}}

        <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Pendapatan
                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-slate-800">
                        Rp 0
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        Hari ini
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-emerald-100 text-emerald-600">

                    <i data-lucide="banknote" class="h-6 w-6"></i>

                </div>

            </div>

        </div>


        {{-- Kendaraan --}}

        <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Kendaraan
                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-slate-800">
                        0
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        Sedang parkir
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-orange-100 text-orange-600">

                    <i data-lucide="car-front" class="h-6 w-6"></i>

                </div>

            </div>

        </div>


        {{-- Petugas --}}

        <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Petugas
                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-slate-800">
                        0
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        Petugas aktif
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-purple-100 text-purple-600">

                    <i data-lucide="users" class="h-6 w-6"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Ringkasan --}}

        <div class="xl:col-span-2 rounded-xl bg-white
                    border border-slate-200 shadow-sm">

            <div class="flex items-center justify-between
                        border-b border-slate-200 px-5 py-4">

                <div>
                    <h2 class="font-semibold text-slate-800">
                        Ringkasan Transaksi
                    </h2>

                    <p class="text-sm text-slate-500">
                        Aktivitas transaksi parkir hari ini
                    </p>
                </div>

                <i data-lucide="bar-chart-3"
                   class="h-5 w-5 text-slate-400">
                </i>

            </div>

            <div class="p-5">

                <div class="flex h-64 items-center justify-center
                            rounded-lg bg-slate-50 border border-dashed
                            border-slate-300">

                    <div class="text-center">

                        <i data-lucide="chart-no-axes-column"
                           class="mx-auto h-10 w-10 text-slate-300">
                        </i>

                        <p class="mt-3 text-sm font-medium text-slate-500">
                            Belum ada data transaksi
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Data grafik akan muncul setelah transaksi tersedia.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Informasi Akun --}}

        <div class="rounded-xl bg-white
                    border border-slate-200 shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">

                <h2 class="font-semibold text-slate-800">
                    Informasi Akun
                </h2>

                <p class="text-sm text-slate-500">
                    Akun yang sedang digunakan
                </p>

            </div>

            <div class="p-5 space-y-5">

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 items-center justify-center
                                rounded-full bg-blue-100 text-blue-600">

                        <i data-lucide="user" class="h-7 w-7"></i>

                    </div>

                    <div>

                        <p class="font-semibold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-slate-500">
                            {{ auth()->user()->username }}
                        </p>

                    </div>

                </div>


                <div class="rounded-lg bg-slate-50 p-4">

                    <div class="flex items-center justify-between">

                        <span class="text-sm text-slate-500">
                            Role
                        </span>

                        <span class="rounded-full bg-purple-100
                                     px-3 py-1 text-xs font-semibold
                                     text-purple-700">

                            Owner

                        </span>

                    </div>

                </div>


                <div class="rounded-lg bg-emerald-50 p-4">

                    <div class="flex items-center gap-3">

                        <i data-lucide="shield-check"
                           class="h-5 w-5 text-emerald-600">
                        </i>

                        <div>

                            <p class="text-sm font-medium text-emerald-800">
                                Akun Aktif
                            </p>

                            <p class="text-xs text-emerald-600">
                                Anda dapat mengakses dashboard owner.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         MENU CEPAT
    ====================================================== --}}

    <div class="rounded-xl bg-white border border-slate-200 shadow-sm">

        <div class="border-b border-slate-200 px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Menu Owner
            </h2>

            <p class="text-sm text-slate-500">
                Akses cepat fitur pengelolaan parkir
            </p>

        </div>


        <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-3">

            <a href="#"
               class="group rounded-xl border border-slate-200 p-4
                      transition hover:border-blue-300 hover:bg-blue-50">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-lg bg-blue-100 text-blue-600">

                        <i data-lucide="receipt"
                           class="h-5 w-5">
                        </i>

                    </div>

                    <div>

                        <p class="font-medium text-slate-800">
                            Transaksi
                        </p>

                        <p class="text-xs text-slate-500">
                            Lihat transaksi parkir
                        </p>

                    </div>

                </div>

            </a>


            <a href="#"
               class="group rounded-xl border border-slate-200 p-4
                      transition hover:border-emerald-300 hover:bg-emerald-50">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-lg bg-emerald-100 text-emerald-600">

                        <i data-lucide="chart-column"
                           class="h-5 w-5">
                        </i>

                    </div>

                    <div>

                        <p class="font-medium text-slate-800">
                            Rekap Transaksi
                        </p>

                        <p class="text-xs text-slate-500">
                            Lihat rekap transaksi
                        </p>

                    </div>

                </div>

            </a>


            <a href="#"
               class="group rounded-xl border border-slate-200 p-4
                      transition hover:border-purple-300 hover:bg-purple-50">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-lg bg-purple-100 text-purple-600">

                        <i data-lucide="file-text"
                           class="h-5 w-5">
                        </i>

                    </div>

                    <div>

                        <p class="font-medium text-slate-800">
                            Laporan
                        </p>

                        <p class="text-xs text-slate-500">
                            Lihat laporan parkir
                        </p>

                    </div>

                </div>

            </a>

        </div>

    </div>

</div>

@endsection