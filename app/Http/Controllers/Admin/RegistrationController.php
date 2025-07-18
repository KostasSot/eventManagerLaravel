<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $registrations = DB::table('event_user')
            ->join('users', 'event_user.user_id', '=', 'users.id')
            ->join('events', 'event_user.event_id', '=', 'events.id')
            ->select('event_user.*', 'users.name as user_name', 'events.title as event_title')
            ->when($request->event_id, fn($q) => $q->where('event_id', $request->event_id))
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->orderByDesc('created_at')
            ->paginate(10);

        $users = User::select('id', 'name')->orderBy('name')->get();
        $events = Event::select('id', 'title')->orderBy('title')->get();

        return Inertia::render('Admin/Registrations/Index', [
            'registrations' => $registrations,
            'users' => $users,
            'events' => $events,
            'filters' => $request->only(['event_id', 'user_id'])
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        $event = Event::find($data['event_id']);

        // Check capacity
        if ($event->current_registrations_count >= $event->capacity) {
            return back()->with('success', 'Event is full.');
        }

        // Attach user
        if (!$event->users()->where('user_id', $data['user_id'])->exists()) {
            $event->users()->attach($data['user_id']);
            $event->increment('current_registrations_count');
        }

        return redirect()->back()->with('success', 'Registration added.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        $event = Event::find($request->event_id);

        $event->users()->detach($request->user_id);
        $event->decrement('current_registrations_count');

        return redirect()->back()->with('success', 'Registration removed.');
    }
}
