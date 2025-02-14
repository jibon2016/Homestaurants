<x-admin-app-layout>

    {{-- Success message from Session--}}
    <x-session-success-msg />

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-5  text-center">
            <a class="bg-gray-500 text-gray-100 px-2 py-2 rounded-md shadow-md" href="{{route('units.create')}}">Add New Unit</a>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">
                  Unit name
                </th>
                <th scope="col" class="px-6 py-3">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($units as $unit)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $unit->unit_name }}
                  </th>
                  <td class="px-6 py-4">
                    <div class="button-group flex">
                      <x-admin-edit-button href="{{route('units.edit', $unit->id)}}" />
                      <form action="{{ route('units.destroy', $unit->id) }}" method="POST">
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

</x-admin-app-layout>
