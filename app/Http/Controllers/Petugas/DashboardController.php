<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\AreaParkir;
use App\Models\Transaksi;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->toDateString();

        $statistics = [
            'kendaraanMasuk' => Transaksi::query()
                ->whereDate('waktu_masuk', $today)
                ->count(),
            'kendaraanKeluar' => Transaksi::query()
                ->where('status', 'keluar')
                ->whereDate('waktu_keluar', $today)
                ->count(),
            'sedangParkir' => Transaksi::query()
                ->where('status', 'masuk')
                ->count(),
            'pendapatanHariIni' => (float) Transaksi::query()
                ->where('status', 'keluar')
                ->whereDate('waktu_keluar', $today)
                ->sum('total_biaya'),
        ];

        $transaksiTerbaru = Transaksi::query()
            ->with(['kendaraan', 'areaParkir'])
            ->latest('waktu_masuk')
            ->limit(5)
            ->get();

        $areaParkir = AreaParkir::query()
            ->orderBy('id_area')
            ->get();

        return view('petugas.dashboard', compact(
            'statistics',
            'transaksiTerbaru',
            'areaParkir',
        ));
    }
}
