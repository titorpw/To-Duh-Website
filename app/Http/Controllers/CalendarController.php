<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Menampilkan halaman kalender.
     */
    public function index()
    {
        return view('dashboard.calendar');
    }
}
