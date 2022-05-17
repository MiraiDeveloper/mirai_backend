<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Request $request)
    {
        $request->validate([
            'images' => ['required',]
        ]);

        $image = $product->images()->create([
            'images' => $request->images
        ]);

        return response()->json(['status' => true, 'messages' => 'data berhasil disimpan', 'data' => $image]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductImages  $productImages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $productImages)
    {
        $request->validate([
            'image' => ['required']
        ]);

        $productImage = ProductImages::find($productImages);

        $productImage->images = $request->image;
        $productImage->save();

        return response()->json(['status' => true, 'messages' => 'data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImages  $productImages
     * @return \Illuminate\Http\Response
     */
    public function destroy($productImages)
    {
        $productImage = ProductImages::find($productImages);

        $productImage->delete();
        return response()->json(['status' => true, 'messages' => 'data berhasil dihapus']);
    }
}
