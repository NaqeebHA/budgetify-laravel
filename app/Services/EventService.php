<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Budget;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventService
{
    public function getAllEvents()
    {
        return Event::all();
    }

    public function findEventById($id)
    {
        return Event::find($id);
    }

    public function updateEvent($id, array $data)
    {
        $event = Event::find($id);

        if ($event) {
            return $event->update($data);
        }

        return false;
    }

    public function updateEventByRequest(UpdateEventRequest $request, Event $event)
    {
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
    }

    public function eventDropdowns()
    {
        $budgets = Budget::all();
        return ['budgets' => $budgets];
    }

    public function addEvent(StoreEventRequest $request)
    {
        $created_event = Event::create($request->all());

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('event-attachments', 'public');
            $created_event->attachment = $path;
            $created_event->save();
        }
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();
    }

    public function deleteEventAttachment(Event $event)
    {
        Storage::delete('public/' . $event->attachment);
        $event->attachment = null;
        $event->save();
    }

    public function eventByTimeframe($date_from, $date_to)
    {
        $event = Event::where('from_time', '>',  $date_from . ' 00:00:00')
        ->where('to_time', '<', $date_to . ' 23:59:59')
        ->get();
        return $event;
    }

    // public function analyticsByAccount($in_out,  $date_from, $date_to)
    // {
    //     $event = event::select('budgets.name AS account', DB::raw('SUM(event.amount) AS total'))
    //     ->leftJoin('budgets', 'event.account_id', '=', 'budgets.id')
    //     ->whereBetween('event.txn_datetime', [$date_from . ' 00:00:00', $date_to . ' 23:59:59'])
    //     ->where('event.in_out', '=', $in_out)
    //     ->groupBy('account')
    //     ->get();
    //     // dd($event);
    //     return $event;
    // }
}
