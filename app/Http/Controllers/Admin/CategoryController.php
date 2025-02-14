<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // View all categories
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('admin.category.index')->with([
            'categories'  => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Parent categories for creating subcategory
        $mainCategories = Category::where('parent_id', null)->get();
        //dd($mainCategories);

        return view('admin.category.create', ['mainCategories' => $mainCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'name'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric',
      ]);

      Category::create($validatedData);

      return redirect()->route('category.index')->withSuccess('You have successfully created a Category!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $this->validate($request, [
            'name'  => 'required|min:3|max:255|string',
        ]);

        $category->update($validatedData);

        return redirect()->route('category.index')->withSuccess('You have successfully updated a Category!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete category
        // Perform any necessary checks, authorization, or validation before deleting

        $category->delete();

        // Optionally, you can add a flash message or return a response indicating the successful deletion

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
        }
}
