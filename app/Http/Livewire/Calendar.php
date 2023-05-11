<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Service\EventService;
use Carbon\CarbonImmutable;

class Calendar extends Component
{

    public $current_date;
    public $current_week;
    public $day;
    public $check_day;
    public $day_of_week;
    public $seven_days_later;
    public $events;

    public function mount()
    {
        $this->current_date = Carbon::today();
        $this->seven_days_later = $this->current_date->addDays(7);
        $this->current_week = [];

        $this->events = EventService::GetWeekEvents(
            $this->current_date->format('Y-m-d'),
            $this->seven_days_later->format('Y-m-d')
        );

        for($i = 0; $i < 7; $i++){
            $this->day = CarbonImmutable::today()->addDays($i)->format('m月d日');
            $this->check_day = CarbonImmutable::today()->addDays($i)->format('Y-m-d');
            $this->day_of_week = CarbonImmutable::today()->addDays($i)->dayName;
            array_push($this->current_week, [
                'day' => $this->day,
                'check_day' => $this->check_day,
                'day_of_week' => $this->day_of_week  
            ]);
        }

       // dd($this->current_week);
    }

    public function getDate($date)
    {
        $this->current_date = $date;
        $this->current_week = [];

        $this->seven_days_later = Carbon::parse($this->current_date)->addDays(7);

        $this->events = EventService::GetWeekEvents(
            $this->current_date,
            $this->seven_days_later->format('Y-m-d')
        );

        for($i = 0; $i < 7; $i++){
            $this->day = CarbonImmutable::parse($this->current_date)->addDays($i)->format('m月d日');
            $this->check_day = CarbonImmutable::parse($this->current_date)->addDays($i)->format('Y-m-d');
            $this->day_of_week = CarbonImmutable::parse($this->current_date)->addDays($i)->dayName;
            array_push($this->current_week, [
                
                'day' => $this->day,
                'check_day' => $this->check_day,
                'day_of_week' => $this->day_of_week
            ]);
        }
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
