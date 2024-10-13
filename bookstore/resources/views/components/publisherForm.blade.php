@csrf
<div class="mb-5">
    <label for="name" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Title')}}</label>
    <input type="text"  name="name" id="name" value="{{$publisher->name ?? old('name')}}" autocomplete="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
    @error('name')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
</div>
<div class="mb-5">
    <label for="description" class="block mb-2 font-medium text-gray-900 text-md ">{{__('Description')}}</label>
    <input type="address"  name="address" id="address" value="{{$publisher->address ?? old('name')}}" autocomplete="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
    @error('address')
    <span class="text-md text-red-500 my-2">{{$message}}</span>
    @enderror
<input type="submit" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md px-3 py-1 m-1">
