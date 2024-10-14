@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="grid  grid-cols-12 gap-4">
            <div class="md:col-start-3 md:col-span-8">
                <div class="w-full py-2">
                    <h3 class="text-xl my-4">
                        {{__("show Details Of book")}}
                    </h3>
                    <div class="rounded-md overflow-hidden">
                        <table class="text-md bg-slate-900 text-white w-full" >
                            @auth
                            <div class="flex gap-3 justify-center items-center bg-gray-900 p-4">
                                <form action="{{route('addToCart')}}" method="POST" class="flex " >
                                    @csrf
                                    <input type="hidden" value="{{$book->id}}" name="id">
                                    <span><input type="number" name="quantity" value="{{$book->number_of_copies == 0 ? 0:1}}" min="{{$book->number_of_copies == 0 ? 0:1}}" class="w-20 h-8 rounded-md" max="{{$book->number_of_copies}}"></span>
                                    @if ($book->number_of_copies == 0)
                                    <button type="button" class="py-2 px-4 border border-1 text-xs rounded-md text-white  transition duration-700 ease-in-out">{{__("Finish")}}</button>
                                    @else
                                    <button type="submit" class="py-2 px-4 border border-1 text-xs rounded-md text-white  transition duration-700 ease-in-out">{{__("Add to Cart")}}</button>
                                    @endif
                                </form>
                            </div>
                            @endauth
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b">{{__("Title")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->title}}</td>
                            </tr>
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Nomber Of Ratings") . $book->ratings()->count()}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b ">
                                    <span class="score text-md relative ">
                                        <livewire:ratings :book="$book"/>
                                    </span>
                                </td>
                            </tr>
                            @if($book->isbn)
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Number IsBo")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->isbn}}</td>
                            </tr>
                            @endif
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b">{{__("Cover Book")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b"><img class="h-60" src="{{asset('storage/'.$book->cover_image)}}" alt="{{$book->title}}" class="w-full"></td>
                            </tr>
                            @if($book->category)
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Category")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->category->name}}</td>
                            </tr>
                            @endif
                            @if($book->authors()->count() > 0)
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Authors")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">
                                    @foreach ($book->authors as $author)
                                    {{$loop->first ? '':','}}
                                    {{$author->name}}
                                    @endforeach
                                </td>
                            </tr>
                            @endif
                            @if($book->publisher)
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Publisher")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->publisher->name}}</td>
                            </tr>
                            @endif
                            @if($book->description)
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Description")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->description}}</td>
                            </tr>
                            @endif
                            @if($book->publisher_year)
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Publisher Year")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->publisher_year}}</td>
                            </tr>
                            @endif
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Number Of Pages")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->number_of_pages}}</td>
                            </tr>
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Number Of Copies")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->number_of_copies}}</td>
                            </tr>
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{__("Price")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900">${{$book->price}}</td>
                            </tr>
                        </table>
                        @auth
                        @if ($bookFind )
                            <div class="flex justify-between items-center bg-gray-900 p-4">
                                <h4 class=" text-white">{{__('Reting Book')}}</h4>
                                <livewire:star :book="$book"/></td>
                            </div>
                        @endif
                        @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
