<x-calendar-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            イベントカレンダー
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto border border-red-400 event-calendar sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @livewire('calendar')
            </div>
        </div>
    </div>
</x-calendar-layout>