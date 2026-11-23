@extends('layout.layout')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-3 rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 p-6 text-white shadow-2xl shadow-blue-500/20 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-blue-100">Ringkasan operasional</p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight">Dashboard Petugas</h1>
            </div>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-2 text-sm text-blue-50 ring-1 ring-white/20">
                <i data-lucide="clock-3" class="h-4 w-4"></i>
                <span>{{ now()->translatedFormat('d M Y') }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @php
                $cards = [
                    ['label' => 'Kendaraan Masuk', 'value' => $statistics['kendaraanMasuk'], 'caption' => 'Hari ini', 'icon' => 'log-in', 'iconClass' => 'bg-blue-100 text-blue-600'],
                    ['label' => 'Kendaraan Keluar', 'value' => $statistics['kendaraanKeluar'], 'caption' => 'Hari ini', 'icon' => 'log-out', 'iconClass' => 'bg-emerald-100 text-emerald-600'],
                    ['label' => 'Sedang Parkir', 'value' => $statistics['sedangParkir'], 'caption' => 'Kendaraan aktif', 'icon' => 'car-front', 'iconClass' => 'bg-orange-100 text-orange-600'],
                    ['label' => 'Pendapatan', 'value' => 'Rp '.number_format($statistics['pendapatanHariIni'], 0, ',', '.'), 'caption' => 'Hari ini', 'icon' => 'wallet', 'iconClass' => 'bg-violet-100 text-violet-600'],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-slate-500">{{ $card['label'] }}</p>
                            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-800">{{ $card['value'] }}</h2>
                            <p class="mt-1 text-xs text-slate-400">{{ $card['caption'] }}</p>
                        </div>
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl {{ $card['iconClass'] }} shadow-inner">
                            <i data-lucide="{{ $card['icon'] }}" class="h-6 w-6"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1.6fr_1fr]">
            <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-5 py-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Transaksi Terbaru</h2>
                        <p class="mt-1 text-sm text-slate-500">Lima aktivitas parkir terakhir.</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                        <i data-lucide="receipt" class="h-5 w-5"></i>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-[0.14em] text-slate-500">
                            <tr>
                                <th class="px-5 py-3 font-semibold">Plat Nomor</th>
                                <th class="px-5 py-3 font-semibold">Area</th>
                                <th class="px-5 py-3 font-semibold">Masuk</th>
                                <th class="px-5 py-3 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($transaksiTerbaru as $transaksi)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-5 py-4 font-semibold text-slate-700">
                                        {{ $transaksi->kendaraan?->plat_nomor ?? '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                        {{ $transaksi->areaParkir?->nama_area ?? '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                        {{ $transaksi->waktu_masuk?->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $transaksi->status === 'masuk' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                                            {{ ucfirst($transaksi->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-12 text-center text-sm text-slate-400">
                                        Belum ada transaksi parkir.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
                    <h2 class="text-lg font-semibold text-slate-800">Kapasitas Area</h2>
                    <p class="mt-1 text-sm text-slate-500">Kondisi parkir saat ini.</p>
                </div>
                <div class="space-y-4 p-5">
                    @forelse ($areaParkir as $area)
                        @php
                            $persentase = $area->kapasitas > 0 ? min(100, round(($area->terisi / $area->kapasitas) * 100)) : 0;
                            $barColor = $persentase >= 80 ? 'bg-red-500' : ($persentase >= 60 ? 'bg-amber-500' : 'bg-blue-600');
                        @endphp
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-3">
                            <div class="mb-2 flex items-center justify-between text-sm">
                                <span class="font-semibold text-slate-700">{{ $area->nama_area }}</span>
                                <span class="text-slate-500">{{ $area->terisi }}/{{ $area->kapasitas }}</span>
                            </div>
                            <div class="h-2.5 overflow-hidden rounded-full bg-slate-200">
                                <div class="h-full rounded-full {{ $barColor }} transition-all duration-300" style="width: {{ $persentase }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center text-sm text-slate-400">
                            Belum ada data area parkir.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
@endsection
