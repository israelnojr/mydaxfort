<?php

namespace Mydaxfort\Http\Controllers\API;

use auth;
use Mydaxfort\Category;
use Illuminate\Http\Request;
use Mydaxfort\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');
        return  Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [
            'name' =>  ['required', 'string', 'unique:categories'],
            'desc' => [ 'required', 'string', 'max:50'],
        ]);
    
        $slug = str_slug($request->name);
        
        return Category::create([
            'user_id' => auth::id(),
            'name' => $request['name'],
            'desc' => $request['desc'],
            'slug' => $slug,
            'username' => auth::user()->name,
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
        $this->authorize('isAdmin');
        $category = Category::findOrFail($id);
        $this->validate($request, [
            'name' => [ 'required', 'max:191', 'unique:categories,name,'.$category->id],
            'desc' =>  [ 'required'],
        ]);

        $category->update($request->all());
        return ['message' => 'upate category'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $category = Category::findOrFail($id);
        $category->delete();
        return ['message' => 'Category Deleted'];
    }
}
