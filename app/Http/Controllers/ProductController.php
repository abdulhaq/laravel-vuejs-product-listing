<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get products
        $products = Product::orderBy('created_at', 'desc')->paginate(5);

        // Return collection of products as a resource
        return ProductResource::collection($products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $request->isMethod('put') ? Product::findOrFail($request->product_id) : new Product;

        $product->id = $request->input('product_id');
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->body = $request->input('body');

        if ($product->save()) {
            return new ProductResource($product);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get product
        $product = Product::findOrFail($id);

        // Return single product as a resource
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get product
        $product = Product::findOrFail($id);

        if ($product->delete()) {
            return new ProductResource($product);
        }
    }

    public function export()
    {
        (new ProductsExport)->queue('products.xlsx');

        return back()->withSuccess('Export started!');
        //return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
