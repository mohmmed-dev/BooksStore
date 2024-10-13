@if ($errors->any())
    <div {{ $attributes }}>
        {{-- <ul class="mt-3 list-disc list-inside text-sm text-red-600"> --}}
            @error($input)
            <p class="mt-3 list-disc list-inside text-sm text-red-600">{{__($message)}}</p>
            @enderror
        {{-- </ul> --}}
    </div>
@endif
