<div>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- 日本語化する場合は下記を追記 -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
    <div class="text-sm text-center">
        日付を選択してください。本日から最大30日先まで選択可能です。
    </div>
    <input id="calendar" class="block w-full mt-1 mb-2" type="text" name="calendar"
    value="{{ $current_date }}" wire:change="getDate($event.target.value)"/>
    
    <div class="flex mx-auto border border-green-400">
        <x-calendar-time /> 
        @for($i = 0; $i < 7; $i++)
            <div class="w-32">
                    <div class="px-2 py-1 text-center border border-gray-200">{{ $current_week[$i]['day'] }}</div>
                    <div class="px-2 py-1 text-center border border-gray-200">{{ $current_week[$i]['day_of_week'] }}</div>
                
                @for ($j = 0; $j < 21; $j++)
                    @if($events->isNotEmpty())
                        @if (!is_null($events->firstWhere('start_date', 
                            $current_week[$i]['check_day']. " ".\Constant::EVENT_TIME[$j])))
                            @php
                                $event_id = $events->firstWhere('start_date', $current_week[$i]['check_day']. " ".\Constant::EVENT_TIME[$j])->id;
                                $event_name = $events->firstWhere('start_date', $current_week[$i]['check_day']. " ".\Constant::EVENT_TIME[$j])->name;
                                $event_info = $events->firstWhere('start_date', $current_week[$i]['check_day']. " ".\Constant::EVENT_TIME[$j]);
                                $event_period = \Carbon\Carbon::parse($event_info->start_date)->diffInMinutes($event_info->end_date) / 30 - 1;
                            @endphp
                            <a href="{{ route('events.detail', ['id' => $event_id]) }}">
                                <div class="h-8 px-2 py-1 text-xs text-center bg-blue-100 border border-gray-200">
                                    {{ $event_name }}
                                </div>
                            </a>
                            @if ($event_period > 0)
                                @for ($k = 0; $k < $event_period; $k++)
                                <div class="h-8 px-2 py-1 text-center bg-blue-100 border border-gray-200"></div>
                                @endfor
                                @php
                                    $j += $event_period
                                @endphp
                            @endif
                        @else
                            <div class="h-8 px-2 py-1 text-center border border-gray-200"></div>
                        @endif
                    @else
                        <div class="h-8 px-2 py-1 text-center border border-gray-200"></div>
                    @endif
                @endfor
            </div> 
        @endfor
    </div>
</div>

<script>
    flatpickr('#calendar', {
        locale     : 'ja',
        dateFormat : 'Y-m-d', 
        //minDate: "today",
        maxDate: new Date().fp_incr(30),
        minuteIncrement: 30,
        defaultDate: new Date() 
    });
</script>