<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\User;

class Admin extends Controller
{
    //


    public function adminDashboard()
    {
    	return view('admin/dashboard');
    }

    public function addUser()
    {
        $users = User::all();

    	return view('admin/addUser', compact(['users']));
    }

    public function registerUser(Request $request)
    {
         $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_dash|unique:users|min:3|max:15',
            'role' => 'required',
            'password' => 'required|confirmed',
        ]);

    	$store = new User;
    	$store->name = $request->name;
    	$store->username = $request->username;
    	$store->role = $request->role;
    	$store->password = Hash::make($request->password);
    	$store->save();

    	return redirect()->back()->with('success','Utilisateur ajouté avec succés');
    }
}
