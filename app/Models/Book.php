<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $fillable = ['title', 'isbn',
            'cover_image',
            'category',
            'publisher',
            'authors',
            'description',
            'publisher_year',
            'number_of_pages',
            'number_of_copies', 'price'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function publisher() {
        return $this->belongsTo(publisher::class);
    }

    public function authors() {
        return $this->belongsToMany(Author::class, 'book_author')->withTimestamps();
    }

    public function ratings() {
        return $this->belongsToMany(User::class,'ratings');
    }

    public function rate() {
        return $this->ratings->isNotEmpty() ? $this->ratings()->sum('value') / $this->ratings()->count(): 0 ;
    }
}
