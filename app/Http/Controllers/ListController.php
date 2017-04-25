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
    
    public function create(Request $request)
    {
        $item = new Item;
        $item->item = $request->text;
        $item->save();
        return 'It`s done.';
    }

    public function delete(Request $request)
    {
        Item::where('id', $request->id)->delete();
        return $request->all();
    }

    public function update(Request $request)
    {
        $item = Item::find($request->id);
        $item->item = $request->newText;
        $item->save();
        return $request->all();
    }    
    
    public function search(Request $request)
    {
        //$item = Item::find($request->id);
        //$item->item = $request->newText;
        //$item->save();
        $term = $request->term;
        $items = Item::where('item', 'LIKE','%'.$term.'%')->get();
        if (count($items) == 0) {
            $serachResult[] = 'No item found.';
            return json_encode($serachResult, JSON_PRETTY_PRINT);
        } else {
            foreach($items as $key => $value) {
                $serachResult[] = $value->item;
            }
            return json_encode($serachResult, JSON_PRETTY_PRINT);
        }
        
        /*return $availableTags = [
                "ActionScript",
                "AppleScript",
                "Asp",
                "BASIC",
                "C",
                "C++",
                "Clojure",
                "COBOL",
                "ColdFusion",
                "Erlang",
                "Fortran",
                "Groovy",
                "Haskell",
                "Java",
                "JavaScript",
                "Lisp",
                "Perl",
                "PHP",
                "Python",
                "Ruby",
                "Scala",
                "Scheme"
                ];
                */
    }
}
