<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::sortable()->paginate(5);

        return view('categories.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name'          =>  'required',

        ]);



        $category = new Category;

        $category->category_name = $request->category_name;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category Added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name'      =>  'required',

        ]);


        $category = Category::find($request->hidden_id);

        $category->category_name = $request->category_name;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category Data deleted successfully');
    }


    public function autocomplete(Request $request)
    {
        $search = $request->get('category_name');
        $result = Category::select('id','category_name')->where('category_name', 'LIKE', '%'. $search. '%')->take(5)->get();
        return response()->json($result);
    }
}
