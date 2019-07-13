<?php

namespace Mydaxfort\Http\Controllers\API;

use auth;
use Mydaxfort\HeroHeader;
use Illuminate\Http\Request;
use Mydaxfort\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class HeroHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HeroHeader::all();
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
            'title' =>  ['required', 'string'],
            'short_desc' => [ 'required', 'string', 'max:50'],
        ]);

        $fileName = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        Image::make($request->image)->save(public_path('images/heroHeader/'). $fileName);       

        return HeroHeader::create([
            'category_id' => $request['category_id'],
            'user_id' => auth::id(),
            'username' => auth::user()->name,
            'title' => $request['title'],
            'short_desc' => $request['short_desc'],
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
        $hero = HeroHeader::findOrFail($id);
        $this->validate($request, [
            'category_id' => ['required'],
            'title' =>  ['required', 'string'],
            'short_desc' => [ 'required', 'string', 'max:50'],
        ]);

           if($request->image){
                $fileName = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
                Image::make($request->image)->save(public_path('images/heroHeader/'). $fileName);

                $request->merge(['image' => $fileName]);
           }
   
        $hero->update($request->all());
        return ['message', ' HeroHeader Successful Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hero = HeroHeader::findOrFail($id);
        $hero->delete();
        return ['message' => 'HeroHeader Deleted'];
    }
}
