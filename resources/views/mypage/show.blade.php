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

                    <form id="calcel_{{ $event->id }}" class="py-4" method="post" action="{{ route('mypage.cancel', ['id' => $event->id]) }}">
                        @csrf
                        <a href="#" data-id="{{ $event->id }}" onclick="CancelPost(this)">キャンセルする</button>
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
                                <x-label  value="予約人数" />
                                {{ $reservation->number_of_people }}
                            </div>
                            @if($event->eventDate < \Carbon\Carbon::today()->format('Y年m月d日'))
                                <x-button class="ml-4">
                                    キャンセルする
                                </x-button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function CancelPost(e){
        'use strict';
        if(confirm('本当にキャンセルしてもよろしいですか？')){
            document.getElementById('cancel' + e.dataset.id).submit();
        }
    }
</script>
