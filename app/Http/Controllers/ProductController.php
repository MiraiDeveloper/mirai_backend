<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductResource::collection(Product::with('images')->get());
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required',],
            'image' => ['required',],
            'price' => ['required',],
            'shade' => ['required',],
            'description' => ['required',],
            'tokopedia' => ['required',],
            'shopee' => ['required',],
        ]);

        $product = Product::create([
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price,
            'shade' => $request->shade,
            'description' => $request->description,
            'tokopedia' => $request->tokopedia,
            'shopee' => $request->shopee,
        ]);

        return response()->json(new ProductResource($product));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(new ProductResource($product->load('images')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required',],
            'image' => ['required',],
            'price' => ['required',],
            'shade' => ['required',],
            'description' => ['required',],
            'tokopedia' => ['required',],
            'shopee' => ['required',],
        ]);

        $product->update([
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price,
            'shade' => $request->shade,
            'description' => $request->description,
            'tokopedia' => $request->tokopedia,
            'shopee' => $request->shopee,
        ]);

        return response()->json(['status' => true, 'messages' => 'data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return response()->json(['status' => true, 'messages' => 'data berhasil dihapus']);
    }

    
}
