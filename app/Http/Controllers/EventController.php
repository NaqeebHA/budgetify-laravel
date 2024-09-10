<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Show the form for creating a new event
    public function create()
    {
        return view('events.create');
    }

    // Store a newly created event in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'event created successfully.');
    }

    // Show the form for editing a specific event
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Update a specific event in the database
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'event updated successfully.');
    }

    // Delete a specific event from the database
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'event deleted successfully.');
    }
}
