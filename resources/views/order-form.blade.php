<x-main-layout>
    <div class="pt-20 mt-5 bg-gray-100 dark:bg-gray-950 lg:ml-8">
        <h1 class="px-4 text-2xl font-semibold text-center dark:text-gray-200">Order Details</h1>
        {{-- <div class="container px-4 mx-auto">
            <h1 class="mb-4 text-2xl font-semibold dark:text-gray-200">Order Details</h1>
            <div class="flex flex-col gap-4 md:flex-row">
                <div class="md:w-3/4">
                    <div class="p-6 mb-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="font-semibold text-left dark:text-gray-50">Foods</th>
                                    <th class="font-semibold text-left dark:text-gray-50">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedCartItems as $vendorId => $cartItems)
                                @php
                                    $user_id = auth()->user()->id;
                                    $user_location = DB::table('user_locations')->where('user_id', $user_id)->first();
                                @endphp
                                @foreach($cartItems as $cartItem)
                                @php
                                // Calculate delivery charge for each cart item based on vendor's criteria (e.g., delivery charge rate, quantity)
                                $deliveryChargeRate = $cartItem->food->vendor->deliveryCharge->charge ?? 0.00;
                                $vendorDistance = haversineDistance($cartItem->food->vendor->vendor_latitude, $cartItem->food->vendor->vendor_longitude, $user_location->latitude, $user_location->longitude);
                                $deliveryCharge = $deliveryChargeRate * $vendorDistance * $cartItem->quantity;
                                @endphp
                                <tr>
                                    <td class="py-4">
                                        <div class="lg:flex lg:gap-2">
                                            <img class="w-16 h-16 mr-4" src="{{asset('storage/'.$cartItem->food->featured_image)}}" alt="Product image">
                                            <span class="font-semibold lg:pt-5 dark:text-gray-100">{{$cartItem->food->food_name}}</span>
                                            <p class="font-extrabold lg:pt-5 dark:text-gray-100">{{$cartItem->food->final_price * $cartItem->quantity}}{{$cartItem->food->currency}}</p>
                                        </div>
                                        <span class="text-sm font-semibold lg:pt-5 dark:text-gray-100">by {{ $cartItem->food->vendor->vendor_name }}</span>
                                        <span class="text-sm font-semibold lg:pt-5 dark:text-gray-100">(D. Charge: {{ number_format($deliveryCharge, 2) }})</span>
                                    </td>
                                    <td class="py-4">
                                        <p class="font-extrabold lg:pt-5 dark:text-gray-100">{{$cartItem->quantity}}</p>
                                    </td>

                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="md:w-1/3">
                    <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h2 class="mb-4 text-lg font-semibold dark:text-gray-200">Summary</h2>
                        <div class="flex justify-between mb-2">
                            <span class="dark:text-gray-200">Subtotal</span>
                            <span class="dark:text-gray-200">{{$totalPrice}}{{$cartItem->food->currency}}</span>
                        </div>

                        <div class="flex justify-between mb-2">
                            <span class="dark:text-gray-200">Delivery Charge</span>
                            <span class="dark:text-gray-200">{{$totalDeliveryCharge}}{{$cartItem->food->currency}}</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold dark:text-gray-50">Total</span>
                            <span class="font-semibold dark:text-gray-50">{{$totalPrice + $totalDeliveryCharge}}{{$cartItem->food->currency}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="py-4 mx-2 mb-10 bg-gray-100 dark:bg-gray-950">
        <div class="container px-4 py-4 mx-auto rounded-md shadow-lg dark:bg-gray-800">

            @if ($errors->any())
            <ul class="text-red-400">
                @foreach ($errors->all() as $error)
                <li> {{$error}} </li>
                @endforeach

            </ul>

            @endif
            <form id="order-form" action="{{route('confirm-order')}}" method="POST" accept-charset="UTF-8">
                @csrf

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="customer_name" value="{{auth()->user()->name}}" id="customer_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 peer" placeholder=" " required />
                        <label for="customer_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" value="{{auth()->user()->phone}}" name="customer_phone" id="customer_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 peer" placeholder=" " required />
                        <label for="customer_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone</label>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <select name="delivery_option" id="delivery_option" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 peer">
                        <option value=""> Select Collecting Option</option>
                        <option value="1">Delivery</option>
                        <option value="0">Pickup</option>
                    </select>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="datetime-local" name="expected_receive_time" id="expected_receive_time" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 peer" placeholder=" " required>
                    <label for="expected_receive_time" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Expected Receive Time</label>
                </div>
                </div>

                <div class="relative z-0 w-full mb-6 group" id="address_field">
                    <input type="text" name="delivery_address" value="{{auth()->user()->address}}" id="delivery_address" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 peer" placeholder=" " required />
                    <label for="delivery_address" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Delivery Address</label>
                </div>

                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <select name="payment_method" id="payment_method" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 peer">
                            <option value=""> Choose Payment Method</option>
                            {{-- <option value="bkash">bKash</option>
                            <option value="stripe">Stripe</option>
                            <option value="cash">Cash on delivery</option> --}}
                            <option value="By Card">By Card</option>
                            <option value="By Cash">By Cash</option>
                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="delivery_price" id="delivery_price" value="{{$totalDeliveryCharge}}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 peer" placeholder=" " required  readonly>
                        <label for="delivery_price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Delivery Charge</label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="total_price" id="total_price" value="{{$totalPrice + $totalDeliveryCharge}}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 peer" placeholder=" " required  readonly>
                        <label for="total_price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Total Price</label>
                    </div>
                </div>

                {{-- hidden part of form --}}
                {{-- <input type="text" name="total_price" readonly id="total_price" value="{{$totalPrice + $totalDeliveryCharge}}"> --}}

                <div id="stripe-card-details" class="py-4 my-2 rounded-md shadow-sm bg-gray-50" style="display: none;">
                    {{-- <p class="pb-1 text-sm">Your account will be charged: {{$totalPrice + $totalDeliveryCharge}}{{$cartItem->food->currency}}</p> --}}
                    <div id="card-errors" role="alert">
                        {{-- div for showing Stripe error --}}
                    </div>

                    <div id="card-element"></div>
                </div>

                <button id="confirm-order-btn" type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">Confirm Order</button>
            </form>
        </div>
    </div>

    {{-- JS for stripe
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe instance with your publishable key
        var stripe = Stripe('pk_test_51KgPDxGxvUIKiOqhqt9Xn8GW05KPRf5lWL3wbZQbadotnYxY4cTEgNu68eCGM0jjDd6hYrpN1dZS9BH7MAI4jHp300QBSZza1U');

        // Create a Stripe Elements instance
        var elements = stripe.elements();

        // Create a Stripe card element
        var card = elements.create('card');

        // Mount the card element to the 'card-element' div
        card.mount('#card-element');

        // Handle the form submission
        var form = document.getElementById('order-form');

        // Handle other payment method
        var paymentMethodField = document.getElementById('payment_method');

        form.addEventListener('submit', function(event) {
            if (paymentMethodField.value === 'cash') {
            // Allow the form to submit without further processing
            return;
             }
            else if(paymentMethodField.value === 'bkash'){
                // Change the form action dynamically for bKash payment
                form.action = "{{ route('bkash-create-payment', ['price' => $totalPrice + $totalDeliveryCharge]) }}";
                form.method = "POST"; // Set the form method to POST
                form.submit();
            }

            event.preventDefault();

            // Disable the submit button to prevent multiple clicks
            document.getElementById('confirm-order-btn').disabled = true;

            // Create a payment method and confirm the payment intent
            stripe.createPaymentMethod('card', card).then(function(result) {
                if (result.error) {
                    // Display an error message if there's an issue with the card details
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;

                    // Enable the submit button
                    document.getElementById('confirm-order-btn').disabled = false;
                } else {
                    // Get the payment method ID
                    var paymentMethodId = result.paymentMethod.id;

                    // Submit the form with the payment method ID
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'payment_intent_id');
                    hiddenInput.setAttribute('value', paymentMethodId);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>
    {{-- end stripe js  --}}


    <script>
        const paymentMethodSelect = document.getElementById('payment_method');
        const stripeCardDetails = document.getElementById('stripe-card-details');

        paymentMethodSelect.addEventListener('change', function () {
            const selectedPaymentMethod = this.value;

            if (selectedPaymentMethod === 'stripe') {
                stripeCardDetails.style.display = 'block';
            } else {
                stripeCardDetails.style.display = 'none';
            }
        });
    </script>



    <script>
        const deliveryOptionSelect = document.getElementById('delivery_option');
        const deliveryAddressField = document.getElementById('address_field');

        deliveryOptionSelect.addEventListener('change', function() {
            if (this.value === '1') {
                deliveryAddressField.style.display = 'block';
            } else {
                deliveryAddressField.style.display = 'none';
            }
        });
    </script>
    <!-- User can't select any past date and time -->
    <script>
        // Get the current date and time
        var now = new Date();

        // Convert the current date and time to a string in the format required by the input
        var currentDateTime = now.toISOString().slice(0, 16);

        // Set the min attribute of the input to the current date and time
        document.getElementById('expected_receive_time').setAttribute('min', currentDateTime);
    </script>

    {{-- If pickup is selected then VendorDeliveryCharge won't be added --}}
    <script>
        const deliveryOption = document.getElementById('delivery_option');
        const totalPriceField = document.getElementById('total_price');
        const deliveryPriceField = document.getElementById('delivery_price');
        const totalDeliveryCharge = {{$totalDeliveryCharge}};

        deliveryOption.addEventListener('change', () => {
            const selectedOption = deliveryOption.value;

            if (selectedOption === '0') {
                // If pickup is selected, set the delivery_price to 0.00
                deliveryPriceField.value = '0.00';
                // You can also update the total_price field if needed
                const totalWithoutDelivery = parseFloat({{$totalPrice}});
                totalPriceField.value = totalWithoutDelivery.toFixed(2);
            } else {
                // If delivery is selected, use the original totalDeliveryCharge
                deliveryPriceField.value = totalDeliveryCharge.toFixed(2);
                // You can also update the total_price field if needed
                totalPriceField.value = parseFloat({{$totalPrice + $totalDeliveryCharge}}).toFixed(2);
            }
        });
    </script>

</x-main-layout>
