
@extends('layouts.dashboard')
@section('title')
<h1 class="text-3xl text-black pb-6">{{__('Books')}}</h1>
@endsection

@section('content')
    <a href="{{route('books.create')}}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md px-4 py-2">+ {{__('Add New Book')}}</a>
    <div class="flex justify-between my-2 items-center">
        <form class=" w-26 mx-auto" class="max-w-md mx-auto" action="{{route('books.index')}}" method="GET">
        <select onchange="this.form.submit()" name='limit' id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            <option value="10" {{request()->limit == 10 ? 'selected' :''}}>10</option>
            <option value="15" {{request()->limit == 15 ? 'selected' :''}}>15</option>
            <option value="20" {{request()->limit == 20 ? 'selected' :''}}>20</option>
            <option value="30" {{request()->limit == 30 ? 'selected' :''}}>30</option>
        </select>
        </form>
        <form class=" mx-auto min-w-60 max-w-80" action="{{route('books.search')}}" method="GET">
            <x-search/>
        </form>
    </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-md rtl:text-right text-gray-500">
        <thead class="text-xl text-gray-700 bg-gray-50">
            <tr >
                <th scope="col" class="px-4 py-3 ">
                    {{__('title')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('IsBn')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Categories')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Authors')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Publisher')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Price')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('More')}}
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50">
                <td class="px-6 py-4"><a href="{{route('books.show',$book)}}">{{Str::limit($book->title,10)}}</a></td>
                <td class="px-6 py-4">
                    {{$book->isbn}}
                </td>
                <td class="px-6 py-4">
                    {{$book->category !== null ? $book->category->name : '' }}
                </td>
                <td class="px-6 py-4">
                    @if ($book->authors()->count() > 0)
                        @foreach ($book->authors as $author)
                            {{$loop->first ? '' : ','}}
                            <span>{{$author->name}}</span>
                        @endforeach
                    @endif
                </td>
                <td class="px-6 py-4">
                    {{$book->publisher !== null ? $book->publisher->name : '' }}
                </td>
                <td class="px-6 py-4">
                    ${{$book->price}}
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-center items-center flex-wrap">
                        <a href="{{route('books.edit',$book)}}" class="text-white m-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 ">{{__("Edit")}}</a>
                        <form action="{{route('books.destroy',$book)}}" method="POST">
                            @method("DELETE")
                            @csrf
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1" onclick="return confirm('Are You Sure')">{{__('Delete')}}</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="m-2 ">
    {{$books->links()}}
</div>

@endsection
