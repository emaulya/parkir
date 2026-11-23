<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class KendaraanController extends Controller
{
    public function index()
    {
        $rows = DB::table('tb_kendaraan')->get();
        return view('admin.Kendaraan.index', compact('rows'));
    }
}