<x-vendor-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-16">
            {{ __('Subscribe to Sale') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-sm mx-auto">
        <p class="text-gray-500 dark:text-gray-300">You will be charged <span class="text-lg p-2 rounded-sm"> ${{number_format($plan->price, 2)}} for {{$plan->name}}</span>  plan <br>from</p>


        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form id="payment-form" class="space-y-6" action="{{route('subscription.create')}}" method="POST">
                @csrf
                <input type="hidden" name="plan" id="plan" value="{{$plan->id}}">
                {{-- @if($plan->price === 0)
                <button type="submit" id="card-button" data-secret="{{ $intent->client_secret }}" class="w-full text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirm</button>
                @else
                <div>
                    <label for="card-holder-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" name="name" id="card-holder-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="" placeholder="Name on the card" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Card Details</label>
                    <div id="card-element" class="text-gray-500"></div>
                </div>
                <hr>
                <button type="submit" id="card-button" data-secret="{{ $intent->client_secret }}" class="w-full text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Purchase</button>
                @endif --}}

                @if($plan->price === 0)
                    <button type="submit" id="card-button" data-secret="{{ $intent->client_secret }}" class="w-full text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirm</button>
                @else
                    <div>
                        <label for="card-holder-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="card-holder-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="" placeholder="Name on the card" required>
                    </div>
                    <div id="card-details" @if(old('card-details')) style="display:block;" @endif>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Card Details</label>
                        <div id="card-element" class="text-gray-500"></div>
                    </div>
                    <hr>
                    <button type="submit" id="card-button" data-secret="{{ $intent->client_secret }}" class="w-full text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Purchase</button>
                @endif

            </form>
        </div>

    </div>


<!-- Include the Stripe.js library -->
<script src="https://js.stripe.com/v3/"></script>

<script>
    // const stripe = Stripe('{{env('STRIPE_KEY')}}');
    // const elements = stripe.elements();
    // const cardElement = elements.create('card');

    // cardElement.mount('#card-element');

    // const form = document.getElementById('payment-form');
    // const cardBtn = document.getElementById('card-button');
    // const cardHolderName = document.getElementById('card-holder-name');

    // form.addEventListener('submit', async (e) => {
    //     e.preventDefault();
    //     cardBtn.disabled = true;

    //     const { setupIntent, error } = await stripe.confirmCardSetup(
    //         cardBtn.getAttribute('data-secret'),
    //         {
    //             payment_method: {
    //                 card: cardElement,
    //                 billing_details: {
    //                     name: cardHolderName.value,
    //                 },
    //             },
    //         }
    //     );

    //     if (error) {
    //         cardBtn.disabled = false;
    //     } else {
    //         let token = document.createElement('input');
    //         token.setAttribute('type', 'hidden');
    //         token.setAttribute('name', 'token');
    //         token.setAttribute('value', setupIntent.payment_method);
    //         form.appendChild(token);
    //         form.submit();
    //     }
    // });

    const stripe = Stripe('{{env('STRIPE_KEY')}}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    const cardBtn = document.getElementById('card-button');
    const cardHolderName = document.getElementById('card-holder-name');
    const cardDetails = document.getElementById('card-details');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        cardBtn.disabled = true;

        if (cardDetails.style.display !== 'none') {
            const { setupIntent, error } = await stripe.confirmCardSetup(
                cardBtn.getAttribute('data-secret'),
                {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value,
                        },
                    },
                }
            );

            if (error) {
                cardBtn.disabled = false;
            } else {
                let token = document.createElement('input');
                token.setAttribute('type', 'hidden');
                token.setAttribute('name', 'token');
                token.setAttribute('value', setupIntent.payment_method);
                form.appendChild(token);
                form.submit();
            }
        } else {
            form.submit();
        }
    });

</script>

</x-vendor-app-layout>
