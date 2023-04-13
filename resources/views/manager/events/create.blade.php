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
                <input type="text" name="datepicker" id="js-datepicker">
                <input type="text" name="start_time" id="start_time">
                <input type="text" name="end_time" id="end_time">
            </div>
        </div>
    </div>
    <script>
        flatpickr('#js-datepicker', {
          locale     : 'ja',
          dateFormat : 'Y.m.d（D）', 
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
