@extends('layouts.app')

@section('content')
    <div class="container m-auto">
        <div class="md:grid  grid-cols-12 gap-4">
            <div class="md:col-start-3 md:col-span-8">
                <div class="w-full py-2">
                    <div class="">
                            <form class="max-w-md mx-auto mt-4" action="{{route('gallery.authors.search')}}" method="GET">
                                <x-search/>
                            </form>
                        <div class="border-t border-2 my-3"></div>
                        <h3 class="m-2 text-xl">{{$title}}</h3>
                        @if ($authors->count())
                            <div>
                                <ul class="bg-slate-700 text-white p-2 text-xl flex justify-center items-center flex-wrap  rounded-md">
                                    @foreach ($authors as $author)
                                            <a href="{{route('gallery.authors.show',$author)}}">
                                                <li class="px-1 py-2 bg-slate-500 rounded-md m-1">
                                                    {{$author->name}} ({{$author->books()->count()}})
                                                </li>
                                            </a>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                        <div>{{__("There Is Nothing")}}</div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
@endsection
