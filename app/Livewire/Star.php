<?php

namespace App\Livewire;

use App\Models\Rating;
use Livewire\Component;
use Illuminate\Http\Request;


class Star extends Component
{
    public $book;

    public function rating($number)  {
        if(auth()->user()->rated($this->book)) {
            $rating = Rating::where(['user_id' => auth()->user()->id, 'book_id' => $this->book->id])->first();
            $rating->update([
                'value' => $number
            ]);
        } else {
            Rating::create([
                'user_id' => auth()->user()->id,
                'book_id' => $this->book->id,
                'value' => $number,
            ]);
            return back();
        }
    }
    public function render()
    {
        return view('livewire.star');
    }
}
