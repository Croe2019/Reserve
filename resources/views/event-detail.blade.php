<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            イベント詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="max-w-2xl mx-auto">
                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('events.reserve', ['id' => $event->id]) }}">
                        @csrf
                        <div>
                            <x-label for="event_name" value="イベント名" />
                            {{ $event->name }}
                        </div>

                        <div class="mt-4">
                            <x-label for="information" value="イベント詳細" />
                            {!! nl2br(e($event->information)) !!}
                        </div>

                        <div class="justify-between md:flex">
                            <div class="mt-4">
                                <x-label for="event_date" value="イベント日付" />
                               {{ $event->EventDate }}
                            </div>

                            <div class="mt-4">
                                <x-label for="start_time" value="開始時間" />
                                {{ $event->StartTime }}
                            </div>

                            <div class="mt-4">
                                <x-label for="end_time" value="終了時間" />
                                {{ $event->EndTime }}
                            </div>
                        </div>

                        <div class="items-end justify-between md:flex">
                            <div class="mt-4">
                                <x-label for="max_people" value="定員数" />
                                {{ $event->max_people }}
                            </div>
                            
                            <div class="mt-4">
                                @if ($reservable_people <= 0)
                                    <span class="text-xs text-red-500">このイベントは満員です</span>
                                @else
                                    <x-label for="reserved_people" value="予約人数" />
                                    <select name="reserved_people">
                                        
                                        @for($i = 1; $i <= $reservable_people; $i++)
                                            <option value="{{ $i }}">
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                @endif
                                
                            </div>
                            @if($is_reserved === null)
                                <input type="hidden" name="id" value="{{ $event->id }}">
                                @if ($reservable_people > 0)
                                    <x-button class="ml-4">
                                        予約する
                                    </x-button>
                                @endif
                            @else
                                <span class="text-xs">このイベントはすでに予約済みです。
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        flatpickr('#event_date', {
          locale     : 'ja',
          dateFormat : 'Y-m-d', 
          defaultDate: new Date() 
        });
    </script>

    <script>
        flatpickr('#start_time',{
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
            time_24hr: true,
            minTime: '10:00',
            maxTime: '20:00'
        });

        flatpickr('#end_time', {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
            time_24hr: true,
            minTime: '10:00',
            maxTime: '20:00'
        });
    </script>
</x-app-layout>
