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
        $today = Carbon::today();

        $reserved_people = DB::table('reservations')
        ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
        ->whereNull('canceled_date')
        ->groupBy('event_id');

        $events = DB::table('events')
        ->leftJoinSub($reserved_people, 'reserved_people',
        function($join){
            $join->on('events.id', '=', 'reserved_people.event_id');
        })
        ->whereDate('start_date', '>=' ,$today)
        ->orderBy('start_date', 'asc')
        ->paginate(10);
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
        $reservations = [];

        $event = Event::findOrFail($event->id);
        $users = $event->users;
        foreach($users as $user)
        {
            $reserved_info = [
                'name' => $user->name,
                'number_of_people' => $user->pivot->number_of_people,
                'canceled_date' => $user->pivot->canceled_date
            ];
            array_push($reservations, $reserved_info);
        }
        
        $event_date = $event->EventDate;
        $start_date = $event->StartTime;
        $end_date = $event->EndTime;
        return view('manager.events.show', compact('event', 'reservations' ,'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $event = Event::findOrFail($event->id);
        $today = Carbon::today()->format('Y年m月d日');
        if($event->eventDate < $today){
            return abort(404);
        }
        $event_date = $event->EventDate;
        $start_date = $event->StartTime;
        $end_date = $event->EndTime;
        return view('manager.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $check = EventService::CountEventDuplication($request['event_date'], $request['start_time'], $request['end_time']);

        if($check > 1){
            $event = Event::findOrFail($event->id);
            $event_date = $event->EventDate;
            $start_date = $event->StartTime;
            $end_date = $event->EndTime;
            session()->flash('status', 'この時間帯にはすでに予約があります。');
            return view('manager.events.edit', compact('event', 'event_date', 'start_date', 'end_date'));
        }

        $startDate = EventService::JoinDateAndTime($request['event_date'], $request['start_time']);
        $endDate = EventService::JoinDateAndTime($request['event_date'], $request['end_time']);
        $event = Event::findOrFail($event->id);
        $event->name = $request['event_name'];
        $event->information = $request['information'];
        $event->start_date = $startDate;
        $event->end_date = $endDate;
        $event->max_people = $request['max_people'];
        $event->is_visible = $request['is_visible'];

        $event->save();
        session()->flash('status', '更新しました');
        return to_route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    public function past()
    {
        $today = Carbon::today();
        $reserved_people = DB::table('reservations')
        ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
        ->whereNull('canceled_date')
        ->groupBy('event_id');

        $events = DB::table('events')
        ->leftJoinSub($reserved_people, 'reserved_people',
        function($join){
            $join->on('events.id', '=', 'reserved_people.event_id');
        })
        ->whereDate('start_date', '<', $today)
        ->orderBy('start_date', 'desc')
        ->paginate(10);

        return view('manager.events.past', compact('events'));
    }
}
