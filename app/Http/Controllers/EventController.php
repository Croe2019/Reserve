<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Service\EventService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = DB::table('events')->orderBy('start_date', 'asc')->paginate(10);
        return view('manager.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $check = EventService::CheckEventDuplication($request['event_date'], $request['start_time'], $request['end_time']);

        if($check){
            session()->flash('status', 'この時間帯にはすでに予約があります。');
            return view('manager.events.create');
        }

        $startDate = EventService::JoinDateAndTime($request['event_date'], $request['start_time']);
        $endDate = EventService::JoinDateAndTime($request['event_date'], $request['end_time']);
        EventService::Store($request['event_name'], $request['information'], $request['max_people'],
        $startDate, $endDate, $request['is_visible']);

        return to_route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event = Event::findOrFail($event->id);
        $event_date = $event->EventDate;
        $start_date = $event->StartTime;
        $end_date = $event->EndTime;
        return view('manager.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
