<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            イベント新規登録
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

                    <form method="POST" action="{{ route('events.update', ['event' => $event->id]) }}">
                        @csrf
                        @method('put')

                        <div>
                            <x-label for="event_name" value="イベント名" />
                            <x-input id="event_name" class="block w-full mt-1" type="text" name="event_name" value="{{ $event->name }}" required/>
                        </div>

                        <div class="mt-4">
                            <x-label for="information" value="イベント詳細" />
                            <x-textarea row="3" name="information" id="information" class="block w-full mt-1">{{ $event->information }}</x-textarea>
                        </div>

                        <div class="justify-between md:flex">
                            <div class="mt-4">
                                <x-label for="event_date" value="イベント日付" />
                                <x-input id="event_date" class="block w-full mt-1" type="text" name="event_date" value="{{ $event->EventDate }}" required />
                            </div>

                            <div class="mt-4">
                                <x-label for="start_time" value="開始時間" />
                                <x-input id="start_time" class="block w-full mt-1" type="text" name="start_time" value="{{ $event->StartTime }}" required />
                            </div>

                            <div class="mt-4">
                                <x-label for="end_time" value="終了時間" />
                                <x-input id="end_time" class="block w-full mt-1" type="text" name="end_time" value="{{ $event->EndTime }}" required />
                            </div>
                        </div>

                        <div class="items-end justify-between md:flex">
                            <div class="mt-4">
                                <x-label for="max_people" value="定員数" />
                                <x-input id="max_people" class="block w-full mt-1" type="number" name="max_people" value="{{ $event->max_people }}" required />
                            </div>
                            <div class="flex justify-around space-x-4">
                                <input type="radio" name="is_visible" value="1" @if($event->is_visible === 1) { checked } @endif>表示
                                <input type="radio" name="is_visible" value="0" @if($event->is_visible === 0) { checked } @endif>非表示
                            </div>
                            <x-button class="ml-4">
                                更新する
                            </x-button>
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
