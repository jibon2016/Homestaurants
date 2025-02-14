<x-main-layout>
    <div class="w-full bg-gray-50 dark:bg-gray-900">
        <section class="max-w-4xl pt-10 pb-4 mx-auto mt-10 bg-gray-50 dark:bg-gray-900">
            <div class="max-w-screen-md px-4 py-8 mx-auto lg:py-16">
                <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-center text-gray-900 dark:text-white">Contact Us</h2>
                <p class="pb-4 mb-8 font-light text-center text-gray-500 lg:mb-16 dark:text-gray-400 sm:text-xl">Any technical issue? Any feedback about us? Want to partner with us? Please let us know.</p>
                <!-- Update the form action to point to the 'contact.send' route -->
                <form action="{{ route('contact.send') }}" method="post" class="mb-4 space-y-4">
                    @csrf <!-- Add CSRF protection -->

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                        <input type="email" id="email" name="email" class="shadow-sm mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light" placeholder="name@homestaurants.com" required>
                    </div>
                    <div>
                        <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                        <input type="text" id="subject" name="subject" class="block w-full p-3 mb-4 text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light" placeholder="Let us know how we can help you" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block mb-2 font-medium text-gray-900 text-md dark:text-gray-400">Your Message</label>
                        <textarea id="message" name="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Leave a comment..."></textarea>
                    </div>
                    <button type="submit" class="px-5 py-3 font-medium text-center text-white bg-green-500 rounded-lg text-md sm:w-fit hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-400 dark:hover:bg-green-600 dark:focus:ring-green-500">Send Message</button>
                </form>
                <div class="text-center text-gray-800 dark:text-gray-200">
                    <h2 class="text-lg">Or do you want to file a complaint? </h2>
                    <a href="{{route('report')}}" class="text-lg font-extrabold text-yellow-400 underline">Report</a>
                </div>
            </div>

        </section>
    </div>

    <x-session-message />
</x-main-layout>

