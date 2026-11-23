@extends('layout.layout')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard Admin')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Dashboard Admin
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Selamat datang kembali, {{ auth()->user()->name }}.
        </p>
    </div>


    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        {{-- TOTAL KENDARAAN --}}
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Total Kendaraan
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800 mt-2">
                        0
                    </h3>
                </div>

                <div class="w-11 h-11 bg-blue-100 text-blue-600
                            rounded-lg flex items-center justify-center">

                    <i data-lucide="car-front"
                       class="w-6 h-6">
                    </i>

                </div>

            </div>

        </div>


        {{-- TRANSAKSI --}}
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Transaksi Hari Ini
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800 mt-2">
                        0
                    </h3>
                </div>

                <div class="w-11 h-11 bg-green-100 text-green-600
                            rounded-lg flex items-center justify-center">

                    <i data-lucide="receipt"
                       class="w-6 h-6">
                    </i>

                </div>

            </div>

        </div>


        {{-- USER --}}
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Total User
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800 mt-2">
                        3
                    </h3>
                </div>

                <div class="w-11 h-11 bg-purple-100 text-purple-600
                            rounded-lg flex items-center justify-center">

                    <i data-lucide="users"
                       class="w-6 h-6">
                    </i>

                </div>

            </div>

        </div>


        {{-- PENDAPATAN --}}
        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Pendapatan Hari Ini
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800 mt-2">
                        Rp 0
                    </h3>
                </div>

                <div class="w-11 h-11 bg-yellow-100 text-yellow-600
                            rounded-lg flex items-center justify-center">

                    <i data-lucide="banknote"
                       class="w-6 h-6">
                    </i>

                </div>

            </div>

        </div>

    </div>


    {{-- AKTIVITAS --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm">

        <div class="p-5 border-b border-slate-200">

            <h2 class="font-semibold text-slate-800">
                Aktivitas Terbaru
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Aktivitas sistem terbaru akan tampil di sini.
            </p>

        </div>


        <div class="p-8 text-center">

            <div class="w-14 h-14 mx-auto bg-slate-100
                        rounded-full flex items-center justify-center">

                <i data-lucide="activity"
                   class="w-7 h-7 text-slate-400">
                </i>

            </div>

            <p class="mt-4 text-sm text-slate-500">
                Belum ada aktivitas terbaru.
            </p>

        </div>

    </div>

</div>

@endsection