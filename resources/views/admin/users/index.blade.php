
@extends('layouts.dashboard')
@section('title')
<h1 class="text-3xl text-black pb-6">{{__('Users')}}</h1>
@endsection

@section('content')
        <div class="flex justify-between my-2 items-center">
        <form class=" w-26 mx-auto" class="max-w-md mx-auto" action="{{route('users.index')}}" method="GET">
        <select onchange="this.form.submit()" name='limit' id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            <option value="5" {{request()->limit == 5 ? 'selected' :''}}>5</option>
            <option value="10" {{request()->limit == 10 ? 'selected' :''}}>10</option>
            <option value="15" {{request()->limit == 15 ? 'selected' :''}}>15</option>
        </select>
        </form>
        <form class=" mx-auto min-w-60 max-w-80" action="{{route('users.searchUsers')}}" method="GET">
            <x-search/>
        </form>
    </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-md rtl:text-right text-gray-500">
        <thead class="text-xl text-gray-700 bg-gray-50">
            <tr >
                <th scope="col" class="px-4 py-3 ">
                    {{__('Name')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Email')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('Type User')}}
                </th>
                <th scope="col" class="px-4 py-3">
                    {{__('More')}}
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50">
                <td class="px-6 py-4">{{$user->name}}</td>
                <td class="px-6 py-4">
                    {{$user->email}}
                </td>
                <td class="px-6 py-4">
                    {{$user->isSuperAdmin() ? __('SuperAdmin'): ($user->isAdmin() ? __('Admin'): 'User') }}
                </td>
                <td class="px-6 py-4">
                    <form action="{{route('users.update',$user)}}" method="POST" class="flex justify-center items-center gap-1">
                        @method('PATCH')
                        @csrf
                        <select id="level" name="level" class="block max-w-16 pr-5 p-1 text-sm text-gray-900 border border-gray-900 rounded-lg bg-gray-50 focus:ring-gray-900 focus:border-gray-900 ">
                            <option disabled selected>{{__("level")}}</option>
                            <option value="0">{{__('User')}}</option>
                            <option value="1">{{__('Admin')}}</option>
                            <option value="2">{{__('Super Admin')}}</option>
                        </select>
                        @if (auth()->user()->id != $user->id)
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1">{{__("Update")}}</button>
                        @else
                        <dev class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-400 font-medium rounded-lg text-sm px-2 py-1">{{__("Update")}}</dev>
                            @endif
                    </form>
                </td>
                <td class="px-6 py-4">
                    <div>
                        <form action="{{route('users.destroy',$user)}}" method="POST">
                            @method("DELETE")
                            @csrf
                            @if (auth()->user()->id != $user->id)
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1" onclick="return confirm('Are You Sure')">{{__('Delete')}}</button>
                                @else
                                <dev class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-400 font-medium rounded-lg text-sm px-2 py-1" onclick="return confirm('Are You Sure')">{{__('Delete')}}</dev>
                            @endif
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="m-2 ">
    {{$users->links()}}
</div>

@endsection
