<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data event.
     * Jika tidak ada filter, tampilkan maks 3 event per bagian.
     * Jika ada filter, tampilkan semua hasil yang cocok.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $categories = Category::all();

        $isFiltering = $request->filled('search') || $request->filled('category');

        $upcomingQuery = $user->events()
            ->where('is_completed', false)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc');

        if ($request->filled('search')) {
            $upcomingQuery->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $upcomingQuery->where('category_id', $request->category);
        }

        if (!$isFiltering) {
            $upcomingQuery->take(3);
        }

        $upcomingEvents = $upcomingQuery->get();


        $completedQuery = $user->events()
            ->where('is_completed', true)
            ->orderBy('updated_at', 'desc');

        if ($request->filled('search')) {
            $completedQuery->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $completedQuery->where('category_id', $request->category);
        }

        if (!$isFiltering) {
            $completedQuery->take(3);
        }

        $completedEvents = $completedQuery->get();

        return view('dashboard.dashboard', [
            'upcomingEvents' => $upcomingEvents,
            'completedEvents' => $completedEvents,
            'categories' => $categories,
        ]);
    }
}
