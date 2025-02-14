<li>
    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-500 md:p-0 md:w-auto dark:text-gray-300 md:dark:hover:text-green-500 dark:focus:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">{{$dropdown_name}} <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
    <!-- Dropdown menu -->
    <div id="dropdownNavbar" class="w-3/4 sm:w-3/5 md:w-3/6 lg:w-2/7 z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
        <ul class="py-2 text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
          {{$slot}}
        </ul>
    </div>
</li>
