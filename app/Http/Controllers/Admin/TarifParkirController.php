<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TarifParkirController extends Controller
{
    public function index()
    {
        $rows = DB::table('tb_tarif')->get();
        return view('admin.TarifParkir.index', compact('rows'));
    }
}