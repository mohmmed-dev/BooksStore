@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="grid  grid-cols-12 gap-4">
            <div class="md:col-start-3 md:col-span-8 my-2 rounded-md mt-4">
            <a href="/" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">{{__("Shoping")}} +</a>
            </div>
            <div class="md:col-start-3 md:col-span-8 bg-white my-2 rounded-md">
                @if ($books->count())
                    @foreach ($books as $book)
                    <div class=" mt-2 mx-2 py-3 px-2 flex border-b-2 justify-between items-center ">
                        <div class="flex items-center">
                            <img
                                src="{{asset('storage/'.$book->cover_image)}}"
                                class="img-fluid rounded-lg w-20 h-32 "
                                alt="{{$book->title}}"
                            />
                            <div class="mx-2">
                                <h3>{{$book->title}}</h3>
                                <div class="score text-md relative ">
                                    <livewire:ratings :book="$book"/>
                                </div>
                                @if ($book->category->count())
                                <span>{{$book->category->name}}</span>
                                @endif
                                <div>{{__("Date Pay"). $book->pivot->created_at->diffForHumans()}}</div>
                                <div>{{__("Number Of Copise"). $book->number_of_copies}}</div>
                            </div>
                        </div>
                        <div>
                            <div>${{$book->pivot->price}}</div>
                            <div class="my-2">${{$book->pivot->price *  $book->number_of_copies  . __(" Total")}}</div>
                            <a href="{{route('book.details',$book)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1">{{__("More details Books")}}</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-3xl text-center mt-16 ">{{__('There Is Not Book')}}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
