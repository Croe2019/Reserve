<?php
namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Event;

class EventService
{

    public static function CheckEventDuplication($event_date, $start_time, $end_time)
    {
        $check = DB::table('events')
        ->whereDate('start_date', $event_date)
        ->whereTime('end_date', '>', $start_time)
        ->whereTime('start_date', '<', $end_time)
        ->exists();

        return $check;
    }

    public static function JoinDateAndTime($date, $time)
    {
        $join = $date. " ". $time;
        $dateTIme = Carbon::createFromFormat('Y-m-d H:i', $join);
        return $dateTIme;
    }

    public static function Store($event_name, $information, $max_people, $start_date, $end_date, $is_visible)
    {
        Event::create([
            'name' => $event_name,
            'information' => $information,
            'max_people' => $max_people,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'is_visible' => $is_visible

        ]);
    }

    public static function CountEventDuplication($event_date, $start_time, $end_time)
    {
        $check = DB::table('events')
        ->whereDate('start_date', $event_date)
        ->whereTime('end_date', '>', $start_time)
        ->whereTime('start_date', '<', $end_time)
        ->count();

        return $check;
    }
    
}