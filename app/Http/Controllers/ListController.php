<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ListController extends Controller
{
    //
    public function index()
    {
        $items = Item::all();
        return view('list', compact('items'));
    }    
    
    public function create(request $request)
    {
        $item = new Item;
        $item->item = $request->text;
        $item->save();
        return 'It`s done.';
    }

    public function delete(request $request)
    {
        Item::where('id', $request->id)->delete();
        return $request->all();
    }

    public function update(request $request)
    {
        $item = Item::find($request->id);
        $item->item = $request->newText;
        $item->save();
        return $request->all();
    }
}
