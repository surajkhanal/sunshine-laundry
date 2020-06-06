<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Item::all();
        return view('items.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-item');
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create-item');

        $validatedItem = $request->validate([
            'item_name' => 'required', 
            'price' => 'required'
        ]);

        $item = new Item;
        $item->item_name = $request->input('item_name');
        $item->price = $request->input('price');
        if($request->hasFile('item_image')) {
            $path = $request->file('item_image')->store('/images', ['disk' => 'public']);
            $item->item_image = $path;
        }
        $item->save();
        return redirect('/items')->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $this->authorize('manage-item');
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validatedItem = $request->validate([
            'item_name' => 'required', 
            'price' => 'required'
        ]);

        $item->item_name = $request->input('item_name');
        $item->price = $request->input('price');
        if($request->hasFile('item_image')) {
            $path = $request->file('item_image')->store('/images', ['disk' => 'public']);
            $item->item_image = $path;
        }
        $item->save();
        return redirect('/items')->with('success', 'Item updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
