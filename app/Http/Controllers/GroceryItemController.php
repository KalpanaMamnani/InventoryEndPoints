<?php

// app/Http/Controllers/GroceryItemController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroceryItem;

class GroceryItemController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category');

        $groceryItems = ($category)
            ? GroceryItem::where('category', $category)->get()
            : GroceryItem::all();

        return view('grocery-items.index', ['groceryItems' => $groceryItems]);
    }

    public function create()
    {
        return view('grocery-items.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $groceryItem = GroceryItem::create($validatedData);

        return redirect()->route('grocery-items.index')->with('success', 'Grocery item added successfully!');
    }
}
