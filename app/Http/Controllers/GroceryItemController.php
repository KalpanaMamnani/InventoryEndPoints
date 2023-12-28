<?php

// app/Http/Controllers/GroceryItemController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroceryItem;
use App\Models\Discount;

class GroceryItemController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category');
    
        $groceryItems = GroceryItem::when($category, function ($query) use ($category) {
            $query->where('category', $category);
        })->get();
    
        // Check for discounts
        $discounts = Discount::pluck('discount', 'category');
    
        // Apply discounts to grocery items
        $groceryItems->transform(function ($item) use ($discounts) {
            $category = $item->category;
    
            // Set discounted_price to the original price by default
            $item->discounted_price = $item->price;
    
            // Check if a discount exists for the category
            if ($discounts->has($category)) {
                // Apply the discount to the price
                $item->discounted_price = $item->price - ($item->price * $discounts[$category] / 100);
            }
    
            return $item;
        });
    
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

    public function applyDiscount(Request $request)
    {
        // Validate the form data
        $request->validate([
            'categoryname' => 'required',
            'discount' => 'required|numeric|min:0',
        ]);

        // Retrieve form data
        $categoryName = $request->input('categoryname');
        $discountValue = $request->input('discount');

        // Create a new Discount record
        Discount::create([
            'category' => $categoryName,
            'discount' => $discountValue,
        ]);

        // Redirect to the discount form with a success message
        return redirect()->route('discount-form')->with('success', 'Discount applied successfully.');
    }
}
