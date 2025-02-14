<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit;
use App\Models\Category;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($vendor_id, Request $request)
    {
        $vendorFoods = Food::where('vendor_id', $vendor_id);

        // Apply category filter if requested
        $categoryId = $request->input('category');
        if ($categoryId) {
            $vendorFoods->where('category_id', $categoryId);
        }

        $vendorFoods = $vendorFoods->get();

        // Count foods rows
        $numberOfRows = $vendorFoods->count();

        $vendor_details = Vendor::where('id', $vendor_id)->get();

        // For category filtering purposes
        $vendorId = $vendor_id;

        // Get vendor food categories
        $vendorFoodCategories = $vendorFoods->pluck('category.id','category.name')->unique();
        //return dd($vendorFoodCategories);

        return view('vendor-foods', compact('vendorFoods', 'numberOfRows', 'vendor_details', 'categoryId', 'vendorId', 'vendorFoodCategories'));
    }

    /**
     * Show vendor foods on vendor dashboard
     */
    public function vendorFoods() {
        $vendorId = Auth::guard('vendor')->user();

        // whereIn method need to an array in second argurment
        // that's why not Auth::guard('vendor')->user()->id used
        $foods = Food::whereIn('vendor_id', $vendorId)->latest()->paginate(5);
        //return dd($foods);

        return view('vendors.foods.index', compact('foods'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::get();
        //return dd($units);
        //$categories = Category::get();
        $categories = Category::with('children')->whereNull('parent_id')->get();
        //return dd($categories);

        // // Retrieve the vendor_id from the authenticated vendor
        // $vendorId = Auth::guard('vendor')->user()->id;

        // // Retrieve the vendor record from the "vendors" table
        // $vendor = Vendor::find($vendorId);

        // // Get the currency field value
        // $currency = $vendor->currency;

        // return dd($currency);

        return view('vendors.foods.add-food', compact('units', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Food $food, Request $request)
    {
        $formFields = $request->validate([
            //'vendor_id' => 'required',
            'category_id' => 'required',
            'food_name' => 'required',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'first_image' => 'nullable|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'second_image' => 'nullable|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'third_image' => 'nullable|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'fourth_image' => 'nullable|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            //'final_price' => 'required|numeric|min:0',
            //'currency' => 'required',
            'unit_amount' => 'required|numeric|min:0',
            'unit_name' => 'required',
            'available_quantity' => 'required|integer|min:2',
        ]);

         // Calculate the final price
        $price = $formFields['price'];
        $discount = $formFields['discount'];
        $finalPrice = $price - ($price * $discount / 100);
        $formFields['final_price'] = $finalPrice;

        //return dd($formFields);

        if($request->hasFile('featured_image')){
            $formFields['featured_image'] = $request->file('featured_image')->store('foods', 'public');
        }

        if($request->hasFile('first_image')){
            $formFields['first_image'] = $request->file('first_image')->store('foods', 'public');
        }

        if($request->hasFile('second_image')){
            $formFields['second_image'] = $request->file('second_image')->store('foods', 'public');
        }

        if($request->hasFile('third_image')){
            $formFields['third_image'] = $request->file('third_image')->store('foods', 'public');
        }

        if($request->hasFile('fourth_image')){
            $formFields['fourth_image'] = $request->file('fourth_image')->store('foods', 'public');
        }

        // Retrieve the vendor_id from the authenticated vendor
        $vendorId = Auth::guard('vendor')->user()->id;

        // Retrieve the vendor record from the "vendors" table
        $vendor = Vendor::find($vendorId);

        // Get the currency field value
        $currency = $vendor->currency;

        $formFields['vendor_id'] = $vendorId;
        $formFields['currency'] = $currency;

        //return dd($formFields['vendor_id']);

        $food->create($formFields);
        //return dd($formFields);


       return redirect()->route('dashboard.vendor.foods')->with('message', 'Food added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('single-item', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //dd($food);
        $food = Food::findOrFail($id);
        $units = Unit::get();
        //return dd($units);
        //$categories = Category::get();
        $categories = Category::with('children')->whereNull('parent_id')->get();
        // edit food item
        return view('vendors.foods.edit', compact('food', 'units', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $formFields = $request->validate([
            //'vendor_id' => 'required',
            'category_id' => 'required',
            'food_name' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'first_image' => 'nullable|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'second_image' => 'nullable|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'third_image' => 'nullable|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'fourth_image' => 'nullable|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            //'final_price' => 'required|numeric|min:0',
            //'currency' => 'required',
            'unit_amount' => 'required|numeric|min:0',
            'unit_name' => 'required',
            'available_quantity' => 'required|integer|min:2',
        ]);

        // Calculate the final price
        $price = $formFields['price'];
        $discount = $formFields['discount'];
        $finalPrice = $price - ($price * $discount / 100);
        $formFields['final_price'] = $finalPrice;

        //return dd($formFields);

        if($request->hasFile('featured_image')){
            $formFields['featured_image'] = $request->file('featured_image')->store('foods', 'public');
        }

        if($request->hasFile('first_image')){
            $formFields['first_image'] = $request->file('first_image')->store('foods', 'public');
        }

        if($request->hasFile('second_image')){
            $formFields['second_image'] = $request->file('second_image')->store('foods', 'public');
        }

        if($request->hasFile('third_image')){
            $formFields['third_image'] = $request->file('third_image')->store('foods', 'public');
        }

        if($request->hasFile('fourth_image')){
            $formFields['fourth_image'] = $request->file('fourth_image')->store('foods', 'public');
        }


        $food->update($formFields);

        return redirect()->route('dashboard.vendor.foods')->with('success', 'Food item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $food = Food::findOrFail($id);

        $food->delete();

        return redirect()->back()->with('success', 'Food item deleted successfully');
    }
}
