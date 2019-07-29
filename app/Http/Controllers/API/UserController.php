<?php

namespace Mydaxfort\Http\Controllers\API;

use Illuminate\Http\Request;
use Mydaxfort\Http\Controllers\Controller;
use Mydaxfort\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');
        return User::all(); //latest()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $this->authorize('isAdmin');
        $this->validate($request, [
        'name' =>  ['required', 'string'],
        'email' => [ 'required', 'email', 'unique:users'],
        'type' =>  ['required'],
        'password'  => ['required', 'string', 'min:6'],
    ]);

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($request['password']),
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
        ///
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
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' =>  ['required', 'string', 'max:191'],
            'email' => [ 'required', 'email', 'max:191', 'unique:users,email,'.$user->id],
            'type' =>  [ ],
            'password'  => ['sometimes', 'string', 'min:6'],
        ]);

        $user->update($request->all());
        return ['message' => 'upate user'];
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
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'User Deleted'];
    }
}
