@extends('layouts.app')

@section('content')
{{-- <div id="success" style="display: none" class="none md:col-span-8  text-center h-3 p-4 text-white rounded-sm">تمت عملية الشراء بنجاح</div> --}}
<div class="container m-auto">
    <div class="justify-center">
            <div class="mx-auto md:mx-10 lg:w-1/2 lg:mx-auto p-2 my-3">
                <form action="{{route('products.purchase')}}" method="POST" id="subscribe-form" class=" bg-gray-800 px-3 pb-2 rounded-sm w-full text-white ">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="subscription-option">
                                    <label for="plan-silver">
                                        <span class="plan-price bg-slate-700 text-white text-xl p-3 rounded-sm mb-2 block shadow-sm  shadow-slate-300">{{__("Total") . ' $' .$total}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="card-holder-name px-2">{{__('Card Holder Name')}}</label>
                    <input id="card-holder-name" type="text" class=" border-x-0 border-t-0 bg-transparent border-b-1  border-b-white pb-0  hover:border-whit focus:border-white   focus:outline-none focus:ring-0">
            @csrf
            <div class="form-row mt-3">
                <label for="card-element block">{{__('Credit or debit card')}}</label>
                <div id="card-element" class="form-control ">  </div>
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                    </div>
                    <div class="stripe-errors"></div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach
                    </div>
                    @endif
                    <div class="form-group text-center">
                    <button id="card-button" data-secret="{{ $intent->client_secret }}" class="my-3 ml-auto text-white bg-slate-700 hover:bg-white focus:ring-1 hover:text-slate-800 focus:outline-none focus:ring-white font-medium rounded-lg text-md px-4 py-2">{{__("Submit")}}</button> </div>
                </form>
            </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
            var stripe = Stripe("{{ env('STRIPE_KEY') }}");
            var elements = stripe.elements();
            var style = {
                base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                color: '#aab7c4'
                }
            },
                invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
                }
            };
            var card = elements.create('card', {hidePostalCode: true, style: style});
            card.mount('#card-element');
            console.log(document.getElementById('card-element'));
            card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
            });
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;    cardButton.addEventListener('click', async (e) => {
            console.log("attempting");
            const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
            payment_method: {
            card: card,
            billing_details: { name: cardHolderName.value }
            }
            });
        if (error) {
        var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
            }
        else {
            paymentMethodHandler(setupIntent.payment_method);
            }
        });
        function paymentMethodHandler(payment_method) {
            var form = document.getElementById('subscribe-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', payment_method);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>
@endsection
