<?php

namespace App\Http\Controllers;

use App\User;
use App\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = User::whereHas('UserType', function($q){
            $q->whereIn('user_type_name', ['staff']);
        })->get();

        return view('staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'string|max:255',
            'phone_number' => 'required|string|min:9|max:10'
        ]);

        User::create([
            'user_name' => $input['user_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'user_type_id' => UserType::where('user_type_name', 'staff')->first()->id,
            'user_status' => 1,
            'phone_number' => $input['phone_number'],
            'address' => $input['address']
        ]);

        return redirect('/staff')->with('success', 'Staff account created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $staff)
    {
        return redirect('/staff');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $staff)
    {
        
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $staff)
    {
        $rules = [];


        if (!empty($request->input('user_name'))) {
            $rules['user_name'] = 'string|max:255';
        }

        if (!empty($request->input('email'))) {
            if ($staff->email != $request->input('email')) {
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


        if (!empty($request->input('user_name'))) {
            $staff->user_name = $request->input('user_name');
        }

        if (!empty($request->input('email'))) {
            if ($staff->email != $request->input('email')) {
                $staff->email = $request->input('email');
            }
        }

        if (!empty($request->input('password'))) {
            $staff->password = Hash::make($request->input('password'));
        }

        if (!empty($request->input('phone_number'))) {
            $staff->phone_number = $request->input('phone_number');
        }

        if (!empty($request->input('address'))) {
            $staff->address = $request->input('address');
        }

        if(!empty($request->input('status'))) {
            if($request->input('status') == 'on') {
                $staff->user_status = false;
            } else {
                
                $staff->user_status = true;
            }
        }

        $staff->update();

        return redirect('/staff')->with('success', 'Staff info updated successfully');
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
