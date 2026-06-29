<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard-mod.index');
    }
    public function metrics()
    {
        return view('dashboard-mod.metrics');
    }
}
