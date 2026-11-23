<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        // password sengaja tidak ditampilkan
        $rows = DB::table('tb_user')
            ->select('id_user', 'nama_lengkap', 'username', 'role')
            ->get();

        return view('admin.User.index', compact('rows'));
    }
}