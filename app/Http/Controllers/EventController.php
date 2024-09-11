<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Budget;
use Illuminate\Support\Facades\Storage;

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
        $budgets = Budget::all();
        return view('events.create', compact('budgets'));
    }

    // Store a newly created event in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'nullable',
            'description' => 'nullable',
            'attachment' => 'nullable',
            'budget_id' => 'nullable',
            'from_time' => 'nullable',
            'to_time' => 'nullable',
        ]);

        $created_event = Event::create($request->all());

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('event-attachments', 'public');
            $created_event->attachment = $path;
            $created_event->save();
        }

        return redirect()->route('events.index')->with('success', 'Event added successfully.');
    }

    // Show the form for editing a specific event
    public function edit(Event $event)
    {
        $budgets = Budget::all();
        return view('events.edit', compact(['event', 'budgets']));
    }

    // Update a specific event in the database
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'nullable',
            'description' => 'nullable',
            'attachment' => 'nullable',
            'budget_id' => 'nullable',
            'from_time' => 'nullable',
            'to_time' => 'nullable',
        ]);

        if ($request->hasFile('attachment')) {
            if ($event->attachment ?? false) {
                Storage::delete('public/' . $event->attachment);
                $event->update($request->all());
            }
            $file = $request->file('attachment');
            $path = $file->store('event-attachments', 'public');
            $event->attachment = $path;
            $event->save();
        } else {
            $event->update($request->all());
        }
        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    // Delete a specific event from the database
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function deleteAttachment(Event $event)
    {
        Storage::delete('public/' . $event->attachment);
        $event->attachment = null;
        $event->save();

        return response()->json(['success' => 'Attachment deleted successfully.']);
    }
}
