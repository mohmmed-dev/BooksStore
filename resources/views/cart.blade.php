@extends('layouts.app')

@section('head')

@endsection

@section('content')
<div class="container">
    @if(Session::has("flash_message"))
        <div onclick="delete()" id="flash_message" class=" text-center bg-gray-700 text-xl py-2 text-white mx-3 rounded-md my-1">{{session("flash_message")}}</div>
    @endif
    @if ($items->count())
        <div class="grid grid-cols-12 overflow-x-auto relative flex-col-reverse">
            <table class="w-full text-md rtl:text-right text-gray-500 md:col-start-3 md:col-span-8 my-10 overflow-x-auto ">
                <thead class="text-xl text-gray-700 bg-gray-50">
                    <tr >
                        <th scope="col" class="px-4 py-3 ">
                            {{__('Title')}}
                        </th>
                        <th scope="col" class="px-4 py-3">
                            {{__('Price')}}
                        </th>
                        <th scope="col" class="px-4 py-3">
                            {{__('Copise')}}
                        </th>
                        <th scope="col" class="px-4 py-3">
                            {{__('All Price')}}
                        </th>
                        <th scope="col" class="px-4 py-3">
                            {{__('More')}}
                        </th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    @php($totalPrice = 0)
                        @foreach ($items as $item)
                            @php($totalPrice += $item->price * $item->pivot->number_of_copies)
                            <tr class="bg-gray-900 text-white">
                                <td class="px-6 py-4">{{$item->title}}</td>
                                <td class="px-6 py-4">{{$item->price}}</td>
                                <td class="px-6 py-4">{{$item->pivot->number_of_copies}}</td>
                                <td class="px-6 py-4">{{$item->price * $item->pivot->number_of_copies}}</td>
                                <td class="flex justify-center items-center flex-wrap gap-1  px-6 py-4">
                                    <form action="{{route('cart.removeAll',$item->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1">{{__('Remove All')}}</button>
                                    </form>
                                    <form action="{{route('cart.removeOne',$item->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1">{{__('Remove One')}}</button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                <tbody>
            </table>
            <div class="w-full text-md rtl:text-right md:col-start-3 md:col-span-8 px-2 py-2">
                <h4 class="text-white text-xl my-5 bg-slate-900 font-medium rounded-lg px-2 py-1 w-fit">{{__('Total').' '.$totalPrice }}</h4>
                <div class="flex-center position-ref full-height flex justify-between items-start relative">
                    <div class="d-inline-block w-10" id="paypal-button-container"></div>
                    <a href="{{ route('credit.checkout')}}" class="d-inline-block mb-4 btn bg-cart text-white bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-6 py-2" style="text-decoration:none;">
                        <span >{{__('Credit card')}}</span>
                        <i class="fas fa-credit-card"></i>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-3xl text-center mt-16 ">{{__('There Is Not Book')}}</div>
    @endif
</div>

@endsection
@section('script')
  <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AQRWbMAWt343SepNyor-YpDs4my0osewxk53gEf13osU9YwHSJk7Pqxd_Wy1vH-zICZtOrYS3Dz6jF4R&currency=USD"></script>
    {{-- <script src="https://sandbox.paypal.com/sdk/js?client-id=AQRWbMAWt343SepNyor-YpDs4my0osewxk53gEf13osU9YwHSJk7Pqxd_Wy1vH-zICZtOrYS3Dz6jF4Rcomponents=paypal-button-container"></script> --}}
    <script>
        paypal.Buttons({
        style: {
            layout: 'vertical',
            color:  'blue',
            shape:  'rect',
            label:  'paypal'
        }
        }).render('#paypal-button-container');
        // paypal.Buttons({
        // createOrder: (data, actions) => {
        //     //
        // },
        // // Finalize the transaction after payer approval
        // onApprove: (data, actions) => {
        //  //
        // }
        // }).render('#paypal-button-container');
    </script>
@endsection
