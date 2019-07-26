<?php

namespace Mydaxfort\Http\Controllers\API;

use auth;
use Mydaxfort\Product;
use Illuminate\Http\Request;
use Mydaxfort\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $authUser =  auth('api')->user();
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => ['required'],
            'name' =>  ['required', 'string'],
            'short_desc' => [ 'required', 'string', 'max:100'],
            'short_desc' => [ 'required', 'string', 'max:50', 'min:10'],
            'long_desc' => [ 'required', 'string', 'max:500','min:10'],
            'price' => ['required'],
        ]);

        $fileName = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        Image::make($request->image)->save(public_path('images/product/'). $fileName);
        
        $slug = str_slug($request->name);

        return Product::create([
            'category_id' => $request['category_id'],
            'user_id' => auth::id(),
            'username' => auth::user()->name,
            'name' => $request['name'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
            'price' => $request['price'],
            'slug' =>  $slug,
            'image' =>  $fileName
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
        //
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
        $product = Product::findOrFail($id);
        $this->validate($request, [
            'category_id' => ['required'],
            'name' =>  ['required', 'string'],
            'short_desc' => [ 'required', 'string', 'max:100'],
            'short_desc' => [ 'required', 'string', 'max:50', 'min:10'],
            'long_desc' => [ 'required', 'string', 'max:500','min:10'],
            'price' => ['required'],
        ]);
        
        $currentImage = $product->image;

           if($request->image != $currentImage ){
                $fileName = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
                Image::make($request->image)->save(public_path('images/product/'). $fileName);

                $request->merge(['image' => $fileName]);

                $productImage = public_path('images/product/').$currentImage;
                if(file_exists( $productImage)){
                    @unlink( $productImage);
                }
           }
   
        $product->update($request->all());
        return ['message', ' Product Successful Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return ['message' => 'Product Deleted'];
    }
}
