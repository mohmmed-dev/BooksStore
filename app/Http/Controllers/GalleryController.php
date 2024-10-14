<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class GalleryController extends Controller
{
    public function index() {
        $books = Book::Paginate(12);
        $title = __('معرض الكتب');
        return view('gallery',compact('books','title'));
    }

    public function search(Request $request) {
        $books = Book::where('title','like',"%{$request->term}%")->paginate(12);
        $title = 'Result Of Search:'. $request->term;
        return view('gallery',compact('books','title'));
    }
}
