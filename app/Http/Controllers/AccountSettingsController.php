<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountSettingsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('settings.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $rules = [];

        if (!empty($request->input('user_name'))) {
            $rules['user_name'] = 'string|max:255';
        }

        if (!empty($request->input('email'))) {
            if (Auth::user()->email != $request->input('email')) {
                $rules['email'] = 'required|string|email|max:255|unique:users';
            }
        }

        if (!empty($request->input('password'))) {
            $rules['password'] = 'required|string|min:8';
        }

        if (!empty($request->input('phone_number'))) {
            $rules['phone_number'] = 'required|string|min:9|max:10';
        }

        if (!empty($request->input('address'))) {
            $rules['address'] = 'string';
        }
        // validate request if values are not empty
        $request->validate($rules);

        $user = User::find(Auth::id());

        if (!empty($request->input('user_name'))) {
            $user->user_name = $request->input('user_name');
        }

        if (!empty($request->input('email'))) {
            if (Auth::user()->email != $request->input('email')) {
                $user->email = $request->input('email');
            }
        }

        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

        if (!empty($request->input('phone_number'))) {
            $user->phone_number = $request->input('phone_number');
        }

        if (!empty($request->input('address'))) {
            $user->address = $request->input('address');
        }
        

        $user->update();

        return redirect('/account-settings/' . Auth::id() . '/edit')->with('success', 'Account info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
