<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AreaParkirController extends Controller
{
    public function index()
    {
        $rows = DB::table('tb_area_parkir')->get();
        return view('admin.AreaParkir.index', compact('rows'));
    }
}