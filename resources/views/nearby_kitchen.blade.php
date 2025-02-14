
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-full">
    @if($numberOfRows > 0)
    @foreach ($nearbyVendors as $nearbyVendor)

    <div class="relative mx-auto w-full">
      {{-- <a href="{{route('vendor.foods', $nearbyVendor->id)}}" class="relative inline-block duration-300 ease-in-out transition-transform transform hover:-translate-y-2 w-full"> --}}
        <div class="shadow p-4 rounded-lg bg-white dark:bg-gray-800">
          <div class="flex justify-center relative rounded-lg overflow-hidden h-40">
            <div class="transition-transform duration-500 transform ease-in-out hover:scale-110 w-full">
              <div class="absolute inset-0 bg-black opacity-90">
                <img src="{{$nearbyVendor->cover_photo === null ? asset('images/default_food.webp'): asset('storage/'.$nearbyVendor->cover_photo)}}"alt="">
              </div>
            </div>

            @if ($nearbyVendor->offerBadge)
                <span class="absolute top-0 left-0 inline-flex mt-3 ml-3 px-3 py-0.5 rounded-lg z-10 bg-blue-500 text-sm font-bold select-none">
                    <span class="text-gray-200">{{$nearbyVendor->offerBadge->badge_line}}</span>
                </span>
            @endif
          </div>

          <div class="mt-4">
            <div class="flex flex-wrap justify-between">
                <p class="font-bold text-base md:text-lg text-yellow-400 dark:text-yellow-300 line-clamp-1" title="New York">
                    <a href="{{route('vendor.foods', $nearbyVendor->id)}}">{{$nearbyVendor->vendor_name}}</a>
                </p>
                <p class="font-bold text-base md:text-lg text-gray-800 dark:text-gray-200 line-clamp-1">
                    <span class="flex">
                        {{-- <span>
                            <svg class="inline-block w-5 h-5 xl:w-4 xl:h-4 mr-3 fill-current text-gray-800 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M399.959 170.585c-4.686 4.686-4.686 12.284 0 16.971L451.887 239H60.113l51.928-51.444c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0l-84.485 84c-4.686 4.686-4.686 12.284 0 16.971l84.485 84c4.686 4.686 12.284 4.686 16.97 0l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L60.113 273h391.773l-51.928 51.444c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l84.485-84c4.687-4.686 4.687-12.284 0-16.971l-84.485-84c-4.686-4.686-12.284-4.686-16.97 0l-7.07 7.071z"></path></svg>
                        </span> --}}
                        <span> {{$nearbyVendor->distance}} km</span>
                    </span>
                </p>
            </div>
          </div>

          <div class="flex justify-between text-gray-800 dark:text-gray-200 py-4">
            @php
            $totalRatingRows = \App\Models\Rating::where('vendor_id', $nearbyVendor->id)->count();
            //dd($totalRatingRows);
            $totalRating = \App\Models\Rating::where('vendor_id', $nearbyVendor->id)->sum('rating');
            if ($totalRatingRows > 0 ) {
                $avgRating = $totalRating / $totalRatingRows;
            } else {
                $avgRating = 0;
            }
            @endphp

            <span class="flex">
              <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="mr-1 h-5 w-5 text-green-600 dark:text-green-500">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                  </svg>
                  <span class="dark:text-gray-200 pr-1 font-semibold">{{number_format($avgRating, 1)}} </span>
                  <span class="dark:text-gray-200 font-semibold">{{'('.$totalRatingRows.')'}}</span>
            </span>
            @if ($avgRating > 0)
            <span class="inline-flex items-center px-4 border border-transparent rounded-md font-semibold text-sm tracking-widest">
              <a href="{{route('vendor.ratings', $nearbyVendor->id)}}">
                <svg fill="none" class="w-4 h-4 mb-1 text-gray-950 dark:text-white" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"></path>
                </svg>
              </a>
            </span>
            @endif
          </div>

          <div class="flex justify-between text-gray-800 dark:text-gray-200 pb-4">
              <span class="flex">
                <svg fill="none" class="w-5 h-5 mr-1 text-green-600 dark:text-green-500" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>

                @php
                $currentTime = \Carbon\Carbon::now()->format('H:i:s'); // Getting current time in the desired format
                    $isOpen = false;
                    // Get the schedule for the current day
                    $currentDayName = \Carbon\Carbon::now()->dayName;

                    $currentDaySchedule = $nearbyVendor->schedules->where('day', $currentDayName)->first();

                    // // Get the schedule for the current day
                    // $currentDaySchedule = $nearbyVendor->schedules->where('day', \Carbon\Carbon::now()->dayOfWeekIso)->first();

                    // return dd($currentDaySchedule); // it's working now

                    if ($currentDaySchedule) {
                        $openTime = \Carbon\Carbon::parse($currentDaySchedule->opening_time)->format('H:i:s');
                        $closeTime = \Carbon\Carbon::parse($currentDaySchedule->closing_time)->format('H:i:s');
                        //return dd($closeTime)

                        if (\Carbon\Carbon::parse($currentTime)->between(
                            \Carbon\Carbon::parse($openTime),
                            \Carbon\Carbon::parse($closeTime)
                        )) {
                            $isOpen = true;
                        }
                    }

                    if (!empty($currentDaySchedule)) {
                        $open_at = \Carbon\Carbon::parse($currentDaySchedule->opening_time)->format('h:i A');
                        // $open_at = \Carbon\Carbon::parse($currentDaySchedule->opening_time)->format('h:i');
                        $close_at = \Carbon\Carbon::parse($currentDaySchedule->closing_time)->format('h:i A');
                        // $close_at = \Carbon\Carbon::parse($currentDaySchedule->closing_time)->format('h:i');
                        $today = \Carbon\Carbon::now();

                        // Check if today is an off day
                        $offDays = explode(',', $currentDaySchedule->off_day);
                        if (in_array(strtolower($today->englishDayOfWeek), $offDays)) {
                            $nextOpenDay = $today->addDays(1); // Move to tomorrow
                        } else {
                            $nextOpenDay = $today;
                        }

                        // Find the next open day
                        while (in_array(strtolower($nextOpenDay->englishDayOfWeek), $offDays)) {
                            $nextOpenDay->addDays(1);
                        }

                        // Format the next open day
                        // $nextOpenDayFormatted = $nextOpenDay->format('l, F jS');
                        // Get the day name without the date
                        $nextOpenDayFormatted = $nextOpenDay->format('l');

                        // Calculate the open time on the next open day
                        $nextOpenTime = $nextOpenDay->format('Y-m-d') . ' ' . $open_at;
                    }
                @endphp

                @if ($nearbyVendor->schedules->isEmpty())
                    <span class="font-semibold">Not added yet</span>
                @else
                    {{-- @if ($isOpen)
                        <span id="close-time" class="font-semibold">Closes at {{$close_at}}</span>
                    @else
                        <span class="pb-1 font-semibold" id="open-time">Opens at {{$open_at}} </span>
                    @endif --}}
                    <span class="pb-1 font-semibold">Open/Close Timings </span>
                @endif
            </span>

            <span class="inline-flex items-center px-4 border border-transparent rounded-md font-semibold text-sm tracking-widest">
            @if ($nearbyVendor->schedules->isNotEmpty())
            <a href="{{route('vendor.shedules', $nearbyVendor->id)}}">
              <svg fill="none" class="w-4 h-4 mb-1 text-gray-950 dark:text-white" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"></path>
              </svg>
            </a>
            @endif
            </span>
        </div>

          <div class="flex justify-between text-gray-800 dark:text-gray-200">
           <span class="flex font-semibold">
            <svg fill="none" class="w-5 h-5 mr-1 text-green-600 dark:text-green-500" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
            </svg>
            {{$nearbyVendor->foods->count()}} Food item
          </span>
           @if ($nearbyVendor->foods->count() > 0)
           <span class="inline-flex items-center px-4 py-0.5 bg-green-500 dark:bg-green-500 border border-transparent rounded-md font-black text-sm text-white dark:text-white tracking-widest hover:bg-green-600 dark:hover:bg-green-500 focus:bg-green-500 dark:focus:bg-green-300 active:bg-green-700 dark:active:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-green-600 transition ease-in-out duration-150"><a href="{{route('vendor.foods', $nearbyVendor->id)}}">Enjoy</a></span>
           @endif
          </div>

          <div class="grid grid-cols-2 mt-2">
            <div class="flex items-center">
              <div class="relative">
                  <img src="{{$nearbyVendor->avatar === null ? asset('images/vendor_default_logo.png'): asset('storage/'.$nearbyVendor->avatar)}}" alt="" class="rounded-full w-6 h-6 md:w-8 md:h-8 bg-gray-200">
                <span class="absolute top-0 right-0 inline-block w-3 h-3 bg-primary-red rounded-full"></span>
              </div>

              <a href="{{route('chef.details', $nearbyVendor->id)}}" class="ml-2 font-semibold text-gray-800 dark:text-gray-200 line-clamp-1">
                {{Str::limit($nearbyVendor->name, 6, '...')}}
              </a>
            </div>

            <div class="flex gap-2 justify-end">
              <!-- Assuming this is your main view where you are rendering the LikeButton component -->
              @livewire('like-button', ['vendor' => $nearbyVendor])
            </div>

          </div>
        </div>
      {{-- </a> --}}
    </div>
    @endforeach
    @else
        <p class="text-center text-red-500">No nearby Homestaurant's found.</p>
    @endif
</div>
<div class="px-2 rounded-sm max-w-sm mx-auto items-center mt-4 mb-10">
    {{$nearbyVendors->links()}}
</div>

{{-- <script>
    // Get the user's local time zone offset in minutes
    var userOffsetMinutes = new Date().getTimezoneOffset();
    var gmtOpenTimeElement = document.getElementById('open-time');
    var gmtCloseTimeElement = document.getElementById('close-time');

    // Function to convert GMT time to local time with AM/PM
    function convertGMTToLocalWithAMPM(gmtTimeString) {
        // Parse the GMT time string to extract the hours and minutes
        var gmtTime = gmtTimeString.match(/\d{2}:\d{2}/); // Extract the time part (e.g., "12:00")

        if (!gmtTime) {
            return 'Invalid Time';
        }

        var gmtTimeParts = gmtTime[0].split(':');
        var gmtHours = parseInt(gmtTimeParts[0]);
        var gmtMinutes = parseInt(gmtTimeParts[1]);

        // Calculate the local time
        var localHours = gmtHours - Math.floor(userOffsetMinutes / 60);
        var localMinutes = gmtMinutes - (userOffsetMinutes % 60);

        // Determine AM or PM
        var ampm = localHours >= 12 ? 'PM' : 'AM';

        // Convert to 12-hour format
        localHours = localHours % 12;
        if (localHours === 0) {
            localHours = 12; // 12 AM or 12 PM
        }

        // Format the local time with AM/PM
        return localHours.toString().padStart(2, '0') + ':' + localMinutes.toString().padStart(2, '0') + ' ' + ampm;
    }

    // Convert and replace the content with the local time with AM/PM
    gmtOpenTimeElement.textContent = 'Opens ' + convertGMTToLocalWithAMPM(gmtOpenTimeElement.textContent);

    if (gmtCloseTimeElement) {
        gmtCloseTimeElement.textContent = 'Closes ' + convertGMTToLocalWithAMPM(gmtCloseTimeElement.textContent);
        gmtCloseTimeElement.style.display = 'inline'; // Show the close time element
    }
</script> --}}



