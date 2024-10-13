<div>
    @if(auth()->user()->rated($book))
        <div class="rating">
            <span class="rating-star text-gray-700 {{auth()->user()->bookRating($book)->value == 5 ? 'checked': ''}}" wire:click='rating(5)'>  <i class="fas fa-solid  fa-star "></i></span>
            <span class="rating-star text-gray-700 {{auth()->user()->bookRating($book)->value == 4 ? 'checked': ''}}" wire:click='rating(4)'>  <i class="fas fa-solid  fa-star "></i></span>
            <span class="rating-star text-gray-700 {{auth()->user()->bookRating($book)->value == 3 ? 'checked': ''}}" wire:click='rating(3)'>  <i class="fas fa-solid  fa-star "></i></span>
            <span class="rating-star text-gray-700 {{auth()->user()->bookRating($book)->value == 2 ? 'checked': ''}}" wire:click='rating(2)'>  <i class="fas fa-solid  fa-star "></i></span>
            <span class="rating-star text-gray-700 {{auth()->user()->bookRating($book)->value == 1 ? 'checked': ''}}" wire:click='rating(1)'>  <i class="fas fa-solid  fa-star "></i></span>
        </div>
        @else
            <span class="rating-star text-gray-700" wire:click='rating(5)'>  <i class="fas fa-solid  fa-star" ></i></span>
            <span class="rating-star text-gray-700" wire:click='rating(4)'>  <i class="fas fa-solid  fa-star" ></i></span>
            <span class="rating-star text-gray-700" wire:click='rating(3)'>  <i class="fas fa-solid  fa-star" ></i></span>
            <span class="rating-star text-gray-700" wire:click='rating(2)'>  <i class="fas fa-solid  fa-star" ></i></span>
            <span class="rating-star text-gray-700" wire:click='rating(1)'>  <i class="fas fa-solid  fa-star" ></i></span>
        @endif
    <div>
</div>
