<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::paginate($request->limit);
        return view('admin.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('admin.books.create',compact('authors','categories','publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'isbn' => ['required','alpha_num','unique:books'],
            'cover_image' => ['required','image'],
            'categories' => 'nullable',
            'publishers' => 'nullable',
            'description' => 'nullable',
            'publish_year' => ['nullable','numeric'],
            'number_of_pages' => ['required','numeric'],
            'number_of_copies' => ['required','numeric'],
            'price' => ['required','numeric'],
        ]);

        $data['cover_image'] = $this->imageUpload($data['cover_image']);
        $book = Book::create($data);
        $book->authors()->attach($request->input('authors'));
        session()->flash("flash_message","Create");
        return redirect(route('books.show',$book));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('admin.books.edit',compact('book','authors','categories','publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required',
            'categories' => 'nullable',
            'publishers' => 'nullable',
            'description' => 'nullable',
            'publish_year' => ['nullable','numeric'],
            'number_of_pages' => ['required','numeric'],
            'number_of_copies' => ['required','numeric'],
            'price' => ['required','numeric'],
        ]);
        if($request->has('cover_image')) {
            Storage::disk('public')->delete($book->cover_image);
            $book->cover_image = $this->imageUpload($request->file('cover_image'));
        }
        if($book->isbn !== $request->isbn) {
            $request->validate(['isbn' => ['required','alpha_num','unique:books']]);
            $book['isbn'] = $request->isbn;
        }
        $book->update($data);
        $book->authors()->detach();
        $book->authors()->attach($request->input('authors'));
        session()->flash("flash_message","Create");
        return redirect(route('books.show',$book));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Storage::disk('public')->delete($book->cover_image);
        $book->delete();
        session()->flash("flash_message","Delete");
        return redirect(route('books.index'));
    }

    public function details(Book $book) {
        $bookFind = 0;
        if(Auth::check()) {
            $bookFind = auth()->user()->ratedpurches()->where('book_id',$book->id)->first();
        }
        return view('books.details',compact('book','bookFind'));
    }

    public function search(Request $request) {
        $books = Book::where('title','like',"%{$request->term}%")->paginate($request->limit);
        return view('admin.books.index',compact('books'));
    }

    public function imageUpload($img) {
        $image_path = 'app/public/covers';
        $image_height = 600;
        $image_width = 600;
        $img_name = time().'-'.$img->getClientOriginalName();
        $image = Image::read($img);
        $image->resize($image_height, $image_width)->save(storage_path($image_path). '/' . $img_name);
        return 'covers/'.$img_name;
    }

    public function rate(Request $request ,Book $book) {
        if(auth()->user()->rated($book)) {
            $rating = Rating::where(['user_id' => auth()->user()->id, 'book_id' => $book->id])->first();
            $rating->value = $request->value;
            $rating->save();
        } else {
            Rating::create([
                'user_id' => auth()->user()->id,
                'book_id' => $book->id,
                'value' => $request->value,
            ]);
            return back();
        }
    }


}
