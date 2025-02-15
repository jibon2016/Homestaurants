<x-landing-layout>
    <div class="relative bg-gray-50 dark:bg-gray-950 pt-10 pb-10">
        <div class="m-auto px-6 pt-24 md:px-12 lg:pt-[4.8rem] lg:px-7">
            <div class="px-2 md:px-0">
                <h1 class="text-2xl font-extrabold font-sans text-center mx-auto lg:ml-20 uppercase hover:capitalize text-gray-700 dark:text-gray-200 md:text-4xl lg:w-10/12">Newsroom</h1>
            </div>
        </div>
        <div class="px-4 lg:px-10 py-4 dark:text-gray-300">
            <h1 class="text-xl py-3">Homestaurant's Blog</h1>
            <!-- component -->
            <div class="flex gap-4 max-md:flex-col">
                <x-single-blog />
                <x-single-blog />
                <x-single-blog />
            </div>
        </div>
    </div>
</x-landing-layout>
