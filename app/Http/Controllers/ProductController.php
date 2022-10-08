<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Image;
use App\Models\Artisan;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Product::with('artisan')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artisan = $request->artisan_id;
        $product = $request->product_name;
        $category = $request->category_id;
        $description = $request->description;
        $amount = $request->amount;
       // $image = $request->product_picture;

        $validator = validator::make($request->all(), [
            'artisan_id' => 'required|exists:artisans,id',
            'product_name' => ['required', 'string', 'min:3', 'max:20'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string', 'min:10', 'max:500'],
            'amount' => ['required'],
            //'product_picture' => ['nullable', 'string', 'max:1999']
        ]);

        if ($validator->fails()){
            return response([
                'error' => 'Invalid Data',
                'info' => $validator->errors()
            ]);
        }

        $product = Product::create([
            'artisan_id' => $artisan,
            'product_name' => $product,
            'category_id' => $category,
            'description' => $description,
            'amount' => $amount,
            //'image' => $image
        ]);

        if ($request->images){
            foreach ($request->images as $key => $image){
                Image::create([
                    'image_id' => $product->id,
                    'url' => $image['url']
                ]);
            }
        }

        return response([
            'Product Uploaded Succesfully',
            $product
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $artisan = $request->artisan;
        $product = $request->product_name;
        $category = $request->category_id;
        $description = $request->description;
        $amount = $request->amount;
       // $image = $request->image;

        $validator = validator::make($request->all([
            'artisan_id' => ['required','exists:artisan,id'],
            'product_name' => ['required', 'string', 'min:3', 'max:20'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'text', 'min:10', 'max:500'],
            'amount' => ['required'],
           // 'image' => ['nullable', 'string', 'max:1999']
        ]));

        if ($validator->fails()){
            return response([
                'error' => 'Invalid Data',
                'info' => $validator->errors()
            ]);
        }

        $update = Product::findOrFail($id);

        $update->update([
            'artisan_id' => $artisan,
            'product_name' => $product,
            'category_id' => $category,
            'description' => $description,
            'amount' => $amount,
           // 'image' => $image
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);

        $product->delete();

        $products = Product::all();

        return response([
            'Product Successfully Deleted',
            $products
        ]);
    }
}
