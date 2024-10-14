<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $publishers =  Publisher::paginate($request->limit);
        return view('admin.publishers.index',compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'nullable'
        ]);
        Publisher::create($data);
        session()->flash("flash_message",__("Create"));
        return redirect(route('publishers.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit',compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'nullable'
        ]);
        $publisher->update($data);
        session()->flash("flash_message",__("Update"));
        return redirect(route('publishers.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        session()->flash("flash_message",__("Delete"));
        return redirect(route('categories.index'));
    }

    public function result(Publisher $publisher) {
        $books = $publisher->books()->paginate(12);
        $title = __('Books Of Publishers: ').$publisher->name;
        return view('gallery',compact('books','title'));
    }

    public function list() {
        $publishers = Publisher::all()->sortBy('name');
        $title = __("Publishers");
        return view('publishers.index',compact('publishers','title'));
    }

    public function search(Request $request) {
        $publishers = Publisher::where('name','like',"%$request->term%")->get()->sortBy('name');
        $title = __('Result Of Search:'). $request->term;
        return view('publishers.index',compact('publishers','title'));
    }


        public function searchPublishers(Request $request) {
        $publishers =  Publisher::where('name','like',"%{$request->term}%")->paginate($request->limit);
        return view('admin.Publishers.index',compact('publishers'));
    }
}
