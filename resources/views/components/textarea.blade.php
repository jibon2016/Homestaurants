<textarea
    x-data="{ value: '{{ $value }}' }"
    x-init="$watch('value', val => $dispatch('input', val))"
    name="{{ $name }}"
    rows="{{ $rows }}"
    {!! $attributes->merge(['class' => 'form-textarea mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}
    x-model="value"
></textarea>
