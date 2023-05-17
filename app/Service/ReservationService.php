<?php
namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Event;

class ReservationService
{
    public static function detail($id)
    {
        $event = Event::findOrFail($id);

        $reserved_people = DB::table('reservations')
        ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
        ->whereNull('canceled_date')
        ->groupBy('event_id')
        ->having('event_id', $event->id)
        ->first();

        if(!is_null($reserved_people)){
            $reservable_people = $event->max_people - $reserved_people->number_of_people;
        }else{
            $reservable_people = $event->max_people;
        }

        //return view('event-detail', compact('event', 'reservable_people'));
    }
}