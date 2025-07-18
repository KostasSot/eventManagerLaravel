<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\Admin\StoreEventRequest;
use App\Http\Requests\Admin\UpdateEventRequest;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::withCount('users')
        ->orderByDesc('created_at')
        ->paginate(10);



        return Inertia::render('Admin/Events/Index', [
            'events' => $events,
            'filters' => $request->only('search'),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Events/Create');
    }

    public function store(StoreEventRequest $request)
    {
        Event::create($request->validated());

        return redirect()->route('admin.events.index')->with('success', 'Event created!');
    }

    public function edit(Event $event)
    {
        return Inertia::render('Admin/Events/Edit', ['event' => $event]);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return redirect()->route('admin.events.index')->with('success', 'Event updated!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted!');
    }
}
