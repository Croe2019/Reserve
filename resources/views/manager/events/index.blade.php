<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            イベント管理
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-24 mx-auto">
                      <div class="w-full mx-auto overflow-auto lg:w-2/3">
                        <table class="w-full text-left whitespace-no-wrap table-auto">
                          <thead>
                            <tr>
                              <th class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">イベント名</th>
                              <th class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">開始日時</th>
                              <th class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">終了日時</th>
                              <th class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">予約人数</th>
                              <th class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">定員</th>
                              <th class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">表示・非表示</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($events as $event)
                                <tr>
                                <td class="px-4 py-3">{{ $event->name }}</td>
                                <td class="px-4 py-3">{{ $event->start_date }}</td>
                                <td class="px-4 py-3">{{ $event->end_date }}</td>
                                <td class="px-4 py-3">{{ $event->max_people }}</td>
                                <td class="px-4 py-3">{{ $event->is_visible }}</td>
                                <td class="w-10 text-center">
                                    <input name="plan" type="radio">
                                </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{ $events->links() }} <!-- ページネーション表示 -->
                      </div>
                      <div class="flex w-full pl-4 mx-auto mt-4 lg:w-2/3">
                        <a class="inline-flex items-center text-indigo-500 md:mb-2 lg:mb-0">Learn More
                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                          </svg>
                        </a>
                        <button class="flex px-6 py-2 ml-auto text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">Button</button>
                      </div>
                    </div>
                  </section>
            </div>
        </div>
    </div>
</x-app-layout>
