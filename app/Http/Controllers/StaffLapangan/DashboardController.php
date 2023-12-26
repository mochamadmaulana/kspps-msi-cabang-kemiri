<?php

namespace App\Http\Controllers\StaffLapangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('layouts.staff_lapangan');
    }
}
