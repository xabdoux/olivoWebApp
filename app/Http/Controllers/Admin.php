<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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
            'password' => 'required|confirmed|min:6|numeric',
        ]);

        $store = new User;
        $store->name = $request->name;
        $store->username = $request->username;
        $store->role = $request->role;
        $store->password = Hash::make($request->password);
        $store->save();

        return redirect()->back()->with('success', 'Utilisateur ajouté avec succés');
    }

    public function deleteUser($userId)
    {
        if (Auth::user()->id == $userId) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre compte (ADMIN)');
        }
        User::find($userId)->delete();
        return redirect()->back()->with('success', 'Compte supprime avec succes');
    }

    public function updateUser(Request $request, $userId)
    {
        $user = User::find($userId);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->save();
        return redirect()->back()->with('success', 'Compte modifié avec succès');
    }
}
