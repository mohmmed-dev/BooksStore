<?php

namespace App\Livewire;

use Livewire\Component;

class Ratings extends Component
{
    public $book;
    public function render()
    {
        return view('livewire.ratings');
    }
}
