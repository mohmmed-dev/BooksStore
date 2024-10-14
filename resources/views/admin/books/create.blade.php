@extends('layouts.dashboard')
@section('title')
<h1 class="text-3xl text-black pb-6">{{__('Add New Book')}}</h1>
@endsection

@section('content')
<div class="container">
    <div class="grid grid-cols-12 justify-center items-center">
        <div class="md:col-span-2" ></div>
            <div class=" col-span-12 md:col-span-8">
                <form action="{{route('books.store')}}" class="max-w-sm mx-auto" method="POST" enctype="multipart/form-data">
                        <x-bookForm :authors='$authors' :categories='$categories' :publishers='$publishers' />
                    </form>
            </div>
        <div class="md:col-span-2" ></div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function readCoverImage(input) {

        var file = input.files[0];
        var reader  = new FileReader();
        reader.onload = function(e)  {
            var imgElement = document.getElementById('cover-image-thumb');
            imgElement.src = e.target.result;
         }
         reader.readAsDataURL(file);

        }
    </script>
@endsection
