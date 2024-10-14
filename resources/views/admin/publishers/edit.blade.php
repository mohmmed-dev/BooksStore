@extends('layouts.dashboard')
@section('title')
<h1 class="text-3xl text-black pb-6">{{__('Edit New publisher')}}</h1>
@endsection

@section('content')
<div class="container">
    <div class="grid grid-cols-12 justify-center items-center">
        <div class="md:col-span-2" ></div>
            <div class=" col-span-12 md:col-span-8">
                <form action="{{route('publishers.update', $publisher)}}" class="max-w-sm mx-auto" method="POST" enctype="multipart/form-data">
                     @method('PATCH')
                        <x-categoryForm  :publisher='$publisher' />
                    </form>
            </div>
        <div class="md:col-span-2" ></div>
    </div>
</div>
@endsection
