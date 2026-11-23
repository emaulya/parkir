<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $rows = DB::table('tb_log_aktivitas')->orderByDesc('id_log')->get();

        return view('admin.LogAktivitas.index', compact('rows'));
    }
}