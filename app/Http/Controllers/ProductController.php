<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::latest()->paginate(5);

        return view('products.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'  =>  'required',
            'product_description'         =>  'required|string|max:255',
            'product_image'         =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'category_id'         =>  'required'
        ]);

        $file_name = time() . '.' . request()->product_image->getClientOriginalExtension();
        request()->product_image->move(public_path('images'), $file_name);

        $product = new Product();

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_image = $file_name;
        $product->category_id = $request->category_id;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto agregado exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name'  =>  'required',
            'product_description'         =>  'required|string|max:255',
            'product_image'         =>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'category_id'         =>  'required'
        ]);


        $product_image = $request->hidden_product_image;

        if($request->product_image != '')
        {
            $product_image = time() . '.' . request()->product_image->getClientOriginalExtension();

            request()->product_image->move(public_path('images'), $product_image);
        }



        $product_ = Product::find($request->hidden_id);

        $product_->product_name = $request->product_name;

        $product_->product_description = $request->product_description;

        $product_->product_image = $product_image;

        $product_->category_id = $request->category_id;

        $product_->save();

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado satisfactoriamente');
    }



    public function autocomplete(Request $request)
    {
        $search = $request->get('category_name');
        $result = Category::where('category_name', 'LIKE', '%'. $search. '%')->get();
        return response()->json($result);

    }
}
