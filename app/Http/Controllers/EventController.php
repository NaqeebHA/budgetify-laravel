<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Services\EventService;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return view('events.index', compact('events'));
    }

    // Show the form for creating a new event
    public function create()
    {
        $dropdowns = $this->eventService->eventDropdowns();
        return view('events.create', $dropdowns);
    }

    // Store a newly created event in the database
    public function store(StoreEventRequest $request)
    {
        $this->eventService->addEvent($request);
        return redirect()->route('events.index')->with('success', 'Event added successfully.');
    }

    // Show the form for editing a specific event
    public function edit(Event $event)
    {
        $dropdowns = $this->eventService->eventDropdowns();
        return view('events.edit', compact('event'), $dropdowns);
    }

    // Update a specific event in the database
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->eventService->updateEventByRequest($request, $event);
        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    // Delete a specific event from the database
    public function destroy(Event $event)
    {
        $this->eventService->deleteEvent($event);
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    // Delete an attachment from the event
    public function deleteAttachment(Event $event)
    {
        $this->eventService->deleteEventAttachment($event);
        return response()->json(['success' => 'Attachment deleted successfully.']);
    }

    public function analyticsByTimeframe(Request $request)
    {
        $date_from = $request->query('from');
        $date_to = $request->query('to');

        $events = $this->eventService->eventByTimeframe($date_from, $date_to);
        return response()->json($events);
    }
}
