<x-main-layout>
    <div class="w-full bg-gray-50 dark:bg-gray-900">
        <section class="bg-gray-50 dark:bg-gray-900 mt-10 pt-10 pb-4 max-w-4xl mx-auto">
            <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Report</h2>
                <p class="mb-8 pb-4 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">If you have faced any negative thing from our vendor and rider feel free to give information.</p>
                <!-- Update the form action to point to the 'contact.send' route -->
                <form action="{{ route('report.send') }}" method="post" class="space-y-4">
                    @csrf <!-- Add CSRF protection -->

                    <div>
                        <label for="order_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Order ID (Collect from <a class="text-yellow-400 underline" href="{{route('customer.orders')}}">Orders</a> )</label>
                        <input type="text" id="order_id" name="order_id" class="shadow-sm mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light" placeholder="Order ID (eg. 125)" value="{{old('order_id')}}" required>
                    </div>
                    <div>
                        <label for="report_on" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Report on</label>
                        <select name="report_on" id="report_on" class="shadow-sm mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light">
                            <option value="homestaurant">Homestaurant</option>
                            <option value="rider">Rider</option>
                            <option value="both">Homestaurant and Rider</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Write details about what type of unconvenient issues you have faced</label>
                        <textarea id="details" name="details" rows="6" class="block p-2.5 mb-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Write everything clearly we will take an action..."></textarea>
                    </div>
                    <button type="submit" class="py-3 px-5 text-md font-medium text-center text-white rounded-lg bg-green-500 sm:w-fit hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-400 dark:hover:bg-green-600 dark:focus:ring-green-500">Send Report</button>
                </form>
            </div>
        </section>
    </div>

    <x-session-message />
</x-main-layout>

