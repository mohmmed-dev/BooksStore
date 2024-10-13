
@csrf
<div class="mb-5">
    <label for="title" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Title')}}</label>
    <input type="text"  name="title" id="title" value="{{$book->title ?? old('title')}}" autocomplete="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
    @error('title')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="isbn" class="block mb-2 font-medium text-gray-900 text-md ">{{__('IsBn')}}</label>
    <input type="text" name="isbn" id="isbn" value="{{$book->isbn ?? old('isbn')}}" autocomplete="isbn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
    @error('isbn')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="cover_image" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Cover Book')}}</label>
    <input onchange="readCoverImage(this)" type="file"  name="cover_image" id="cover_image" value="{{old('cover_image')}}" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer p-2 bg-gray-50 dark:text-gray-400 focus:outline-none">
    @error('cover_image')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
    <img src="{{asset('storge/'. ($book->cover_image ?? ''))}}" alt="" id="cover-image-thumb">
</div>
<div class="mb-5">
    <label for="ccategory" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Category')}}</label>
    <select id="ccategory" name="ccategory" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-900 rounded-lg bg-gray-50 focus:ring-gray-900 focus:border-gray-900 px-10">
        <option disabled  {{($book->categories ?? '') == null ? 'selected': ''}} >{{__("Choes Category")}}</option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}" {{($book->categories ?? '') == $category ? 'selected': ''}}>{{$category->name}}</option>
        @endforeach
    </select>
    @error('ccategory')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="authors" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Authors')}}</label>
    <select class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-900 rounded-lg bg-gray-50 focus:ring-gray-900 focus:border-gray-900 px-4"  id="authors" name="authors[]" multiple>
        <option disabled selected {{($book ?? null) == null ? 'selected' : ($book->authors()->count() == 0 ? 'selected':'')}}>{{__("Choes Authors")}}</option>
        @foreach ($authors as $author)
            <option value="{{$author->id}}"{{($book ?? null) == null ? 'selected' : ($book->authors->contains($author) ? 'selected':'')}}>{{$author->name}}</option>
        @endforeach
    </select>
    @error('authors')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="publisher" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Publisher')}}</label>
    <select id="publisher" name="publisher" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-900 rounded-lg bg-gray-50 focus:ring-gray-900 focus:border-gray-900 px-10">
        <option disabled  {{($book->publishers ?? "") == null ? 'selected': ''}}>{{__("Choes Category")}}</option>
        @foreach ($publishers as $publisher)
            <option value="{{$publisher->id}}" {{($book->publishers ?? "") == $publisher ? 'selected': ''}}>{{$publisher->name}}</option>
        @endforeach
    </select>
    @error('publisher')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="description" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Description')}}</label>
    <textarea  name="description "id="description" value="{{$book->description ?? old('description')}}" autocomplete="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"></textarea>
    @error('description')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="publisher_year" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Publisher Year')}}</label>
    <input type="number" name="publisher_year" id="publisher_year" value="{{$book->publisher_year ?? old('publisher_year')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
    @error('publisher_year')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="number_of_pages" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Number Of Pages')}}</label>
    <input type="number" name="number_of_pages" id="number_of_pages" value="{{$book->number_of_pages ?? old('number_of_pages')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
    @error('number_of_pages')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="number_of_copies" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Number Of Copies')}}</label>
    <input type="number" name="number_of_copies" id="number_of_copies" value="{{$book->number_of_copies ?? old('number_of_copies')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
    @error('number_of_copies')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="price" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Price')}}</label>
    <input type="number" name="price" id="price" value="{{$book->price ?? old('price')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
    @error('price')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<input type="submit" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md px-3 py-1 m-1"
