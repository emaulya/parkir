<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $rows = DB::table('tb_transaksi')->orderByDesc('id_parkir')->get();
        return view('admin.Transaksi.index', compact('rows'));
    }
}