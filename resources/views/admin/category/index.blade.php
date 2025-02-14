<x-admin-app-layout>

    {{-- Success message from Session--}}
    <x-session-success-msg />

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-5  text-center">
            <a class="bg-gray-500 text-gray-100 px-2 py-2 rounded-md shadow-md" href="{{route('category.create')}}">Add New Category</a>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">
                  Category name
                </th>
                <th scope="col" class="px-6 py-3">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $category->name }}
                  </th>
                  <td class="px-6 py-4">
                    <div class="button-group flex">
                      <x-admin-edit-button href="{{route('category.edit', $category->id)}}" />
                      <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-admin-delete-button />
                      </form>
                    </div>
                  </td>
                </tr>
                @if ($category->children->isNotEmpty())
                  @foreach ($category->children as $subcategory)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                      <th scope="row" class="px-6 text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $subcategory->name }}
                      </th>
                      <td class="px-6 py-4">
                        <div class="button-group flex">
                          <x-admin-edit-button href="{{route('category.edit', $subcategory->id)}}" />

                          <form action="{{ route('category.destroy', $subcategory->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                          <x-admin-delete-button />
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              @endforeach
            </tbody>
          </table>

    </div>

</x-admin-app-layout>
