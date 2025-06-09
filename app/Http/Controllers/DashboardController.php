<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data event.
     */
    public function index()
    {

        $user = Auth::user();

        /** @var \App\Models\User $user */
        $upcomingEvents = $user->events()
            ->where('is_completed', false)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        $completedEvents = $user->events()
            ->where('is_completed', true)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        // 3. Mengirim kedua koleksi data ke view
        return view('dashboard.dashboard', [
            'upcomingEvents' => $upcomingEvents,
            'completedEvents' => $completedEvents,
        ]);
    }
}
