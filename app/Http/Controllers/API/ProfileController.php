<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        return auth('api')->user()->profile;
        // $us = auth('api')->user();
        // dd($us);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $authUser =  auth('api')->user()->profile;

        $this->validate($request, [
            'name' =>  ['required', 'string'],
            'email' => [ 'required', 'email', 'unique:profiles,email,'.$authUser->id],
            'description' =>  ['required', 'string', 'mix:250'],
            'password'  => ['sometimes','string', 'min:6'],
        ]);

        $currentImage = $authUser->image;
        if($request->image != $currentImage){
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            Image::make($request->image)->save(public_path('images/profile/').$name);

            $request->merge(['image' => $name]);
        }
        
        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $authUser->update($request->all());
        return ['message', ' Profile Successful Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
