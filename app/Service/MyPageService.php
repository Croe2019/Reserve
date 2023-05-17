<?php
namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MyPageService
{
    public static function ReservedEvent($events, $string)
    {
        $reserved_events = [];
        if($string === 'from_today')
        {
            foreach($events->sortBy('start_date') as $event)
            {
                if(is_null($event->pivot->canceled_date) &&
                $event->start_date >= Carbon::now()->format('Y-m-d 0:00:00'))
                {
                    $event_info = [
                        'id' => $event->id,
                        'name' => $event->name,
                        'start_date' => $event->start_date,
                        'end_date' => $event->date,
                        'number_of_people' => $event->pivot->number_of_people
                    ];
                    array_push($reserved_events, $event_info);
                }
            }
        }

        if($string === 'past')
        {
            foreach($events->sortByDesc('start_date') as $event)
            {
                if(is_null($event->pivot->canceled_date) &&
                $event->start_date < Carbon::now()->format('Y-m-d 0:00:00'))
                {
                    $event_info = [
                        'id' => $event->id,
                        'name' => $event->name,
                        'start_date' => $event->start_date,
                        'end_date' => $event->date,
                        'number_of_people' => $event->pivot->number_of_people
                    ];
                    array_push($reserved_events, $event_info);
                }
            }
        }

        return $reserved_events;
    }
}