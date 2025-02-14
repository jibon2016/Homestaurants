<x-vendor-app-layout>
    <x-session-success-msg />
    <div class="mx-auto text-center mt-10 pt-16">
        <a href="{{route('vendor.add-food')}}" class="text-gray-100 dark:text-gray-200  bg-green-500 dark:bg-green-400 hover:bg-green-600 dark:hover:bg-green-500 px-2 py-2 rounded-md shadow-md">Add New Food Item</a>
    </div>
    <div class="relative overflow-x-auto flex md:justify-center md:items-center pt-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <table class="w-full md:w-2/3 text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Food Name</th>
                    <th scope="col" class="px-6 py-3">Featured Image</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Discount</th>
                    <th scope="col" class="px-6 py-3">Final Price</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($foods as $food)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th class="px-6 py-4">{{ $food->food_name }}</th>
                    <td class="px-6 py-4"> <x-admin-table-img src="{{asset('storage/' . $food->featured_image)}}" alt="Food Image" /> </td>
                    <td class="px-6 py-4">{{ $food->price}}</td>
                    <td class="px-6 py-4">{{ $food->discount }}</td>
                    <td class="px-6 py-4">{{ $food->final_price }}</td>
                    <td class="px-6 py-4">
                        <div class="button-group flex">
                            <x-admin-edit-button href="{{route('edit.vendor-food', $food->id)}}" />
                            <form action="{{route('delete.vendor-food', $food->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-admin-delete-button />
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-2 rounded-sm max-w-sm mx-auto items-center mt-4">
        {{$foods->links()}}
    </div>

</x-vendor-app-layout>
