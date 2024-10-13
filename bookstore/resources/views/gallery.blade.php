@extends('layouts.app')

@section('head')

@endsection

@section('content')
    <div class="mx-auto px-4 container">
        <div class="mt-5">
            <form class=" max-w-md mx-auto" action="{{route('search')}}" method="GET">
                <x-search/>
            </form>
            <div class="border-t border-2 my-3"></div>
        </div>
        <h3 class="m-2 text-xl">{{$title}}</h3>
        <div class="grid sm:grid-cols-2 md:grid-cols-3  lg:grid-cols-4 justify-center gap-2 gap-x-4 text-center py-2">
            @if ($books->count())
                @foreach ($books as $book)
                    @if($book->number_of_copies > 0)
                        <div class=" col-span-1  bg-white border border-gray-200  shadow max-w-64 rounded-sm overflow-hidden">
                            <div>
                                <a href="{{route('book.details',$book)}}">
                                    <img class=" w-full h-80 " src="{{asset('storage/'.$book->cover_image)}}" alt="{{$book->title}}" />
                                </a>
                            </div>
                            <div class="py-2 px-3">
                                <a href="{{route('book.details',$book)}}">
                                    <h5 class="text-md font-semibold tracking-tight li ">{{$book->title}}</h5>
                                </a>
                                <div class="flex flex-col items-center mt-3">
                                    <div>
                                        @if($book->category != NULL)
                                        <a href="{{route('categories.show',$book->category)}}">
                                            <span class="text-md block font-bold text-gray-900">{{$book->category->name}}</span>
                                        </a>
                                        @endif
                                        <span class="text-md block font-bold text-gray-900">${{$book->price}}</span>
                                    </div>
                                    <div class="score text-md relative ">
                                        <livewire:ratings :book="$book"/>
                                    </div>
                                </div>
                            </div>
                            </div>
                    @endif
                @endforeach
            @else
            <div>
                {{__("There Is Nothing")}}
            </div>
            @endif
        </div>
        <div class="py-3">
            {{$books->links()}}
        </div>
    </div>
@endsection
