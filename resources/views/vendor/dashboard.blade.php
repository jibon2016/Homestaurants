<x-vendor-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Homestaurant\'s Dashboard') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
        class="max-w-sm px-4 py-2 mx-auto font-semibold text-gray-800 bg-green-300 rounded-md items-right dark:text-gray-950">
        {{ session('message') }}
    </div>
    @endif

    {{-- <div class="grid grid-cols-1 gap-2 px-4 py-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="mx-auto rounded-md max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border-2 border-green-500 shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Total Foods</h2>
                    {{$totalAddedFoods}}
                </div>
            </div>
        </div>
        <div class="mx-auto rounded-md max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border-2 border-green-500 shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Total Sale</h2>
                    {{$totalSalePrice}} {{Auth::guard('vendor')->user()->currency}}
                </div>
            </div>
        </div>
        <div class="mx-auto rounded-md max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border-2 border-green-500 shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Total Earn</h2>
                    {{$totalEarn}} {{Auth::guard('vendor')->user()->currency}}
                </div>
            </div>
        </div>
        <div class="mx-auto rounded-md max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border-2 border-green-500 shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>From Pickup</h2>
                    {{$pickupMoney}} {{Auth::guard('vendor')->user()->currency}}
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container">
        <div class="p-4 bg-white dark:bg-gray-800 lg:pl-28">
            <form action="{{ route('vendor.dashboard.filter') }}" method="get">
                @csrf
                <div class="mb-4">
                    <label for="time_period" class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-200">Select Time Period:</label>
                    <select name="time_period" id="time_period" class="w-full rounded-md form-select dark:bg-gray-900 dark: dark:text-gray-200 focus:ring-green-500">
                        <option value="daily" {{ old('time_period', $timePeriod) === 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ old('time_period', $timePeriod) === 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ old('time_period', $timePeriod) === 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ old('time_period', $timePeriod) === 'yearly' ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>

                <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Apply Filter</button>
            </form>
        </div>

        <div class="px-4 py-4 mx-auto lg:px-16 lg:ml-10">
            <div class="grid grid-cols-1 sm:h-24 sm:grid-flow-row sm:gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <div class="flex flex-col justify-center bg-white border border-gray-300 rounded shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex w-full h-full">
                        <div class="flex items-center justify-center w-1/3 bg-green-500">
                            <p class="text-lg font-semibold text-center text-white">{{ $totalAddedFoods }}</p>
                        </div>
                        <div class="flex items-center justify-center w-2/3 ">
                            <p class="text-xl text-center text-gray-900 dark:text-gray-50">Total Foods</p>
                        </div>
                    </div>
                </div>

                {{-- <div class="flex flex-col justify-center bg-white border border-gray-300 rounded shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex w-full h-full">
                        <div class="flex items-center justify-center w-1/3 bg-red-500">
                            <p class="text-lg font-semibold text-center text-white">{{ $totalSalePrice }} {{ Auth::guard('vendor')->user()->currency }}</p>
                        </div>
                        <div class="flex items-center justify-center w-2/3 ">
                            <p class="text-xl text-center text-gray-900 dark:text-gray-50">Total Sale</p>
                        </div>
                    </div>
                </div> --}}

                <div class="flex flex-col justify-center bg-white border border-gray-300 rounded shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex w-full h-full">
                        <div class="flex items-center justify-center w-1/3 bg-blue-500">
                            <p class="text-lg font-semibold text-center text-white">{{ $totalEarn + $pickupMoney }} {{ Auth::guard('vendor')->user()->currency }}</p>
                        </div>
                        <div class="flex items-center justify-center w-2/3 ">
                            <p class="text-xl text-center text-gray-900 dark:text-gray-50">Total Earn</p>
                        </div>
                    </div>
                </div>

                {{-- <div class="flex flex-col justify-center bg-white border border-gray-300 rounded shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex w-full h-full">
                        <div class="flex items-center justify-center w-1/3 bg-indigo-500">
                            <p class="text-lg font-semibold text-center text-white">{{ $pickupMoney }} {{ Auth::guard('vendor')->user()->currency }}</p>
                        </div>
                        <div class="flex items-center justify-center w-2/3 ">
                            <p class="text-xl text-center text-gray-900 dark:text-gray-50">From Pickup</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>


    <div class="px-4 py-4 mx-auto lg:px-16 lg:ml-10">
        <div class="grid gap-2 py-4 lg:grid-cols-2">
            <div class="justify-center w-full py-4 mx-auto lg:flex lg:gap-6">
                <div class="px-4 py-4 rounded-md shadow-md dark:bg-gray-700">
                    {{-- <h2 class="dark:text-gray-50">Bank Account Details</h2>
                    <form action="{{route('edit-withdraw-account')}}" method="POST">
                        @csrf
                        <select name="payment_method" id="payment_method" class="block py-2.5 px-2 rounded-md w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 peer">
                            <option value="">Select Receive Method</option>
                            {{-- <option value="payoneer" {{ $withdrawAccount && $withdrawAccount->payment_method === 'payoneer' ? 'selected' : '' }}>Payoneer</option> --}}
                            {{-- <option value="bkash" {{ $withdrawAccount && $withdrawAccount->payment_method === 'bkash' ? 'selected' : '' }}>bKash</option>
                            <option value="nagad" {{ $withdrawAccount && $withdrawAccount->payment_method === 'nagad' ? 'selected' : '' }}>Nagad</option> --}}
                            {{-- <option value="payoneer" {{ $withdrawAccount && $withdrawAccount->payment_method === 'Mobile Money' ? 'selected' : '' }}>Mobile Money</option>
                        </select>
                        @error('payment_method')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                        <x-input-label for="holder_name" :value="__('Account Holder Name')" />
                        <x-text-input id="holder_name" class="block w-full mt-1" type="text" name="holder_name" :value="$withdrawAccount ? $withdrawAccount->holder_name : ''" required autofocus autocomplete="holder_name" />
                        <x-input-error :messages="$errors->get('holder_name')" class="mt-2" />

                        <x-input-label for="account_no" :value="__('Account No')" />
                        <x-text-input id="account_no" class="block w-full mt-1" type="text" name="account_no" :value="$withdrawAccount ? $withdrawAccount->account_no : ''" required autofocus autocomplete="account_no" />
                        <x-input-error :messages="$errors->get('account_no')" class="mt-2" />

                        <x-input-label for="routing_number" :value="__('Routing Number(optional)')" />
                        <x-text-input id="routing_number" class="block w-full mt-1" type="text" name="routing_number" :value="$withdrawAccount ? $withdrawAccount->routing_number : ''" autofocus autocomplete="routing_number" />
                        <x-input-error :messages="$errors->get('routing_number')" class="mt-2" />

                        <x-primary-button class="mt-2">Update</x-primary-button>
                    </form>

                </div>
                <div class="px-4 py-2 rounded-md shadow-md dark:bg-gray-700">
                    @if ($withdrawAccount==null)
                    <p class="lg:pt-10 dark:text-gray-100">You haven't added withdraw account details yet.</p>
                    @else
                    <p class="lg:pt-10 dark:text-gray-100">Your added account <br> details are: <br> {{$withdrawAccount->payment_method}} <br>
                        {{$withdrawAccount->account_no}} <br> {{$withdrawAccount->vendor->currency}} </p>
                    @endif
                </div>
            </div> --}}
            <div class="justify-center w-full py-4 mx-auto lg:flex lg:gap-6">
                <div class="px-2 py-4 rounded-md shadow-md dark:bg-gray-700">
                    <form action="{{route('edit-delivery-charge')}}" method="POST">
                        @csrf
                        <x-input-label for="charge" :value="__('Add Delivery Charge/km')" />
                        <x-text-input id="charge" class="block w-full mt-1" type="text" name="charge" :value="$deliveryCharge == null ? 0: $deliveryCharge->charge" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('charge')" class="mt-2" />
                        <x-primary-button class="mt-2">Update</x-primary-button>
                    </form>
                </div>
                <div class="px-4 py-2 rounded-md shadow-md dark:bg-gray-700">
                    @if ($deliveryCharge==null)
                    <p class="lg:pt-10 dark:text-gray-100">You haven't fixed delivery charge yet.</p>
                    @else
                    <p class="lg:pt-10 dark:text-gray-100">Your fixed delivery <br> charge is {{$deliveryCharge->charge}}{{$deliveryCharge->vendor->currency}}/km.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class=" mx-auto ">
        <form action="{{route('update-bank-details', ['vendor' => $vendor->id ])}}" method="POST">
        <div class="grid gap-2">
            <div class="justify-center w-full py-4 mx-auto lg:flex lg:gap-6">
                <div class="px-4 py-4 rounded-md shadow-md dark:bg-gray-700">
                <div class="justify-center w-full py-4 mx-auto lg:flex lg:gap-6">
                    <div class="px-2 py-4 rounded-md w-full shadow-md dark:bg-gray-700">
                        @csrf
                        <x-input-label for="bank_name" :value="__('Bank Name')" />
                        <x-text-input id="bank_name" class="w-full mt-1 mb-3" type="text" name="bank_name" :value=" $vendor->bank_name " required autofocus autocomplete="bank_name" />
                        <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />

                        <x-input-label for="bank_ac" :value="__('Bank Account Details')" />
                        <x-text-input id="bank_ac" class="w-full mt-1" type="text" name="bank_ac" :value=" $vendor->bank_ac " required autofocus autocomplete="bank_ac" />
                        <x-input-error :messages="$errors->get('bank_ac')" class="mt-2" />

                        <x-primary-button class="mt-2">Update</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    </div>
</div>
</div>


<x-session-success-msg />
</x-vendor-app-layout>
