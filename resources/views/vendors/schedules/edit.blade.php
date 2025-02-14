<x-vendor-app-layout>

    <div class="relative overflow-x-auto flex md:justify-center items-center mt-10 pt-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <table class="w-full md:w-2/3 text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Day</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Opening Time</th>
                    <th scope="col" class="px-6 py-3">Closing Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th class="px-6 py-4">{{ $schedule->day }}</th>
                    <td class="px-6 py-4">{{ $schedule->off_day ? 'Closed' : 'Open' }}</td>
                    <td class="px-6 py-4">{{ $schedule->opening_time }}</td>
                    <td class="px-6 py-4">{{ $schedule->closing_time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <p class="text-red-500 dark:text-red-400 pt-10 text-center"> Note: Update it according to GMT or UTC time standard.</p> --}}
    <div class="relative p-10 mt-5 flex justify-center items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <form action="{{ route('vendors.schedules.update', $vendor) }}" method="POST" class="my-4">
            @csrf
            @method('PATCH')

            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                @php
                    $schedule = $schedules->firstWhere('day', $day);
                    $openingTime = isset($schedule) ? date('H:i', strtotime($schedule->opening_time)) : '';
                    $closingTime = isset($schedule) ? date('H:i', strtotime($schedule->closing_time)) : '';
                    $offDayValue = isset($schedule) && $schedule->off_day ? 'Closed' : 'Open';
                @endphp
                <div class="my-2">
                    <label for="{{ $day }}_off" class="mr-2 dark:text-gray-300">{{ $day }}</label>
                    <input type="checkbox" id="{{ $day }}_off" name="schedules[{{ $day }}][off_day]" value="{{ $day }}" class="mr-2" {{ $schedule && $schedule->off_day ? 'checked' : '' }}>
                    <label for="{{ $day }}_off" class="mr-2 dark:text-gray-300">Closed</label> <br>
                    <label class="dark:text-gray-200">OT</label>
                    <input type="time" id="{{ $day }}_opening" name="schedules[{{ $day }}][opening_time]" value="{{ $openingTime }}" {{ $schedule && $schedule->off_day ? 'disabled' : '' }} class="px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    <label class="dark:text-gray-200">CT</label>
                    <input type="time" id="{{ $day }}_closing" name="schedules[{{ $day }}][closing_time]" value="{{ $closingTime }}" {{ $schedule && $schedule->off_day ? 'disabled' : '' }} class="px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-green-500 dark:bg-gray-700 dark:text-white">

                    <script>
                        document.getElementById("{{ $day }}_off").addEventListener("change", function() {
                            var openingInput = document.getElementById("{{ $day }}_opening");
                            var closingInput = document.getElementById("{{ $day }}_closing");

                            openingInput.disabled = this.checked;
                            closingInput.disabled = this.checked;
                        });
                    </script>
                </div>
            @endforeach

            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-400 dark:bg-green-400 dark:text-gray-900">Save</button>
        </form>


    </div>


</x-vendor-app-layout>





