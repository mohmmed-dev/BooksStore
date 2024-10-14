@extends('layouts.dashboard')
@section('title')
<h1 class="text-3xl text-black pb-6">{{__('Show Book')}}</h1>
@endsection

@section('content')
   <div class="container">
        <div class="grid  grid-cols-12 gap-4">
            <div class="md:col-start-2 md:col-span-10">
                <div class="w-full py-2">
                    <div class="rounded-md overflow-hidden">
                        <table class="text-md bg-slate-900 text-white w-full" >
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b">{{__("Title")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->title}}</td>
                            </tr>
                            @if($book->isbn)
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Number Adderas")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b">{{$book->isbn}}</td>
                            </tr>
                            @endif
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b">{{__("Cover Image")}}</th>
                                <td class="px-6 py-4 bg-gray-200 text-gray-900 border-b"><img class="h-60" src="{{asset('storage/'.$book->cover_image)}}" alt="{{$book->title}}" class="w-full"></td>
                            </tr>
                            @if($book->category)
                            <tr >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border-b ">{{__("Categoris")}}</th>
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
                                <td class="px-6 py-4 bg-gray-200 text-gray-900">{{$book->price}}</td>
                            </tr>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
