<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard Owner
     */
    public function index()
    {
        return view('owner.dashboard');
    }
}