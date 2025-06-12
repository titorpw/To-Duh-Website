<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Menampilkan form untuk membuat event baru.
     */
    public function create()
    {
        // Mengambil semua kategori dari database untuk ditampilkan di dropdown
        $categories = Category::all();

        // Mengirim data kategori ke view
        return view('dashboard.create-event', compact('categories'));
    }

    /**
     * Menyimpan event baru ke dalam database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'event_date' => 'required|date_format:Y-m-d',
            'event_time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
        ]);

        // 2. Gabungkan tanggal dan waktu menjadi satu format datetime
        $eventDateTime = $validated['event_date'] . ' ' . $validated['event_time'];

        // 3. Buat event baru di database
        Event::create([
            'user_id' => Auth::id(), // ID pengguna yang sedang login
            'category_id' => $validated['category_id'],
            'name' => $validated['event_name'],
            'event_date' => $eventDateTime,
            'description' => $validated['description'],
        ]);

        // 4. Alihkan kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Event successfully created!');
    }

    /**
     * Mengubah status selesai (completed) dari sebuah event.
     */
    public function toggleComplete(Event $event)
    {
        if (auth()->id() !== $event->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $event->update(['is_completed' => !$event->is_completed]);

        return response()->json(['success' => true]);
    }

    /**
     * Menghapus sebuah event dari database.
     */
    public function destroy(Event $event)
    {
        if (auth()->id() !== $event->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $event->forceDelete();

        return response()->json(['success' => true]);
    }

    /**
     * Memperbarui event yang sudah ada di database.
     */
    public function update(Request $request, Event $event)
    {
        if (auth()->id() !== $event->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // 1. Validasi data yang masuk dari form
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'event_date' => 'required|date_format:Y-m-d',
            'event_time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
        ]);

        // 2. Gabungkan tanggal dan waktu menjadi satu format datetime
        $eventDateTime = $validated['event_date'] . ' ' . $validated['event_time'];

        // 3. Update event di database
        $event->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['event_name'],
            'event_date' => $eventDateTime,
            'description' => $validated['description'],
        ]);

        // 4. Alihkan kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Event successfully updated!');
    }

    public function edit(Event $event)
    {
        if (auth()->id() !== $event->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Mengambil semua kategori untuk ditampilkan di dropdown
        $categories = Category::all();

        // Mengirim data event yang spesifik dan semua kategori ke view
        return view('dashboard.edit-event', compact('event', 'categories'));
    }

    public function getEventsForCalendar(Request $request)
    {
        $userId = auth()->id();

        $events = Event::where('user_id', $userId)
            ->get(['name', 'event_date']);

        $formattedEvents = $events->map(function ($event) {
            return [
                'title' => $event->name,
                'start' => $event->event_date,
            ];
        });

        return response()->json($formattedEvents);
    }
}
