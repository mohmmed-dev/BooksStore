<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $authors =  Author::paginate($request->limit);
        return view('admin.authors.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);
        Author::create($data);
        session()->flash("flash_message",__("Create"));
        return redirect(route('authors.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);
        $author->update($data);
        session()->flash("flash_message",__("Update"));
        return redirect(route('authors.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        session()->flash("flash_message",__("Delete"));
        return redirect(route('authors.index'));
    }


     public function result(Author $author) {
        $books = $author->books()->paginate(12);
        $title = __('Books Of author: ').$author->name;
        return view('gallery',compact('books','title'));
    }

    public function list() {
        $authors = Author::all()->sortBy('name');
        $title = __("Authors");
        return view('authors.index',compact('authors','title'));
    }

    public function search(Request $request) {
        $authors = Author::where('name','like',"%$request->term%")->get()->sortBy('name');
        $title = __('Result Of Search:'). $request->term;
        return view('authors.index',compact('authors','title'));
    }

        public function searchAuthors(Request $request) {
        $authors =  Author::where('name','like',"%{$request->term}%")->paginate($request->limit);
        return view('admin.authors.index',compact('authors'));
    }
}
