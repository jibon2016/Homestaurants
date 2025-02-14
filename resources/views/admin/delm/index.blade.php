<x-admin-app-layout>
    {{-- Success message from Session--}}
    <x-session-success-msg />

    <div class="relative mt-5 overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search -->
        <form action="{{route('delm.index')}}">
            <div class="relative border-2 border-gray-100 m-4 rounded-lg">
                <div class="absolute top-4 left-3">
                    <i
                        class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                    ></i>
                </div>
                <input
                    type="text"
                    name="search"
                    class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                    placeholder="Search by vendors email, phone, address, approval status..."
                />
                <div class="absolute top-2 right-2">
                    <button
                        type="submit"
                        class="h-10 w-20 text-white rounded-lg bg-green-500 hover:bg-green-600"
                    >
                        Search
                    </button>
                </div>
            </div>
        </form>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Approval Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Govt. ID(front)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Govt. ID(back)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Car Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        CL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($delms as $delm)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$delm->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$delm->email}}
                    </td>
                    <td class="px-6 py-4">
                        {{$delm->phone}}
                    </td>
                    <td class="px-6 py-4">
                        {{$delm->approval_status}}
                    </td>
                    <td class="px-6 py-4">
                        <x-admin-table-img src="{{asset($delm->govt_front)}}" />
                    </td>
                    <td class="px-6 py-4">
                        <x-admin-table-img src="{{asset($delm->govt_back)}}" />
                    </td>
                    <td class="px-6 py-4">
                        {{$delm->car_type}}
                    </td>
                    @if($delm->car_type == 'motorbike')
                    <td class="px-6 py-4">
                        <x-admin-table-img src="{{asset($delm->driving_license)}}" />
                    </td>
                    <td class="px-6 py-4">
                        <x-admin-table-img src="{{asset($delm->car_license)}}" />
                    </td>
                    @else
                    <td class="px-6 py-4">
                        No
                    </td>
                    <td class="px-6 py-4">
                        No
                    </td>
                    @endif
                    <td class="px-6 py-4">
                        {{$delm->delm_address}}
                    </td>
                    <td class="px-6 py-4">
                        <div class="button-group flex">
                            <x-admin-edit-button href="{{route('delm.edit', $delm)}}" />
                            <form action="{{ route('delm.destroy', $delm) }}" method="POST" id="deleteForm">
                                @csrf
                                @method('DELETE')

                              <x-admin-delete-button onclick="confirmDelete(event)" />
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $delms->links() }}
    </div>
    <script>
        function confirmDelete(event) {
          event.preventDefault(); // Prevent the form from submitting immediately

          if (confirm("Are you sure you want to delete this rider?")) {
            document.getElementById('deleteForm').submit(); // Submit the form
          }
        }
    </script>
    </x-admin-app-layout>
