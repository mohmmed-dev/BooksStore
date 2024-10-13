@extends('layouts.dashboard')
@section('title')
<h1 class="text-3xl text-black pb-6">{{__('Purchasing')}}</h1>
@endsection

@section('content')
        <div class="sm:flex justify-between my-2 items-center">
        <form class=" w-26 mx-auto" class="max-w-md mx-auto" action="{{route('all.product')}}" method="GET">
        <select onchange="this.form.submit()" name='limit' id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
            <option value="10" {{request()->limit == 10 ? 'selected' :''}}>10</option>
            <option value="15" {{request()->limit == 15 ? 'selected' :''}}>15</option>
            <option value="20" {{request()->limit == 20 ? 'selected' :''}}>20</option>
            <option value="30" {{request()->limit == 30 ? 'selected' :''}}>30</option>
        </select>
        </form>
        <form class=" mx-auto min-w-60 max-w-80 sm:flex" action="{{route('searchDate')}}" method="GET">
            <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 w-full  p-1 ">
            <input type="submit" class="text-white  bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-4 py-1 ">
        </form>
    </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-md rtl:text-right text-gray-500">
        <thead class="text-xl text-gray-700 bg-gray-50">
            <tr >
                <th scope="col" class="px-4 py-3 ">
                    {{__('Pay')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Book')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Price')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Copice')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Total')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Date')}}
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50">
                <td class="px-6 py-4">{{$book->user->name}}</td>
                <td class="px-6 py-4">
                    {{Str::limit($book->book->title,10)}}
                </td>
                <td class="px-6 py-4">
                    ${{$book->price}}
                </td>
                <td class="px-6 py-4">
                    {{$book->number_of_copies}}
                </td>
                <td class="px-6 py-4">
                    ${{$book->price * $book->number_of_copies}}
                </td>
                <td class="px-6 py-4">
                    {{$book->created_at->diffForHumans()}}
                </td>
                <td class="px-6 py-4">

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="m-2 ">
    {{-- {{$books->links()}} --}}
</div>

@endsection
