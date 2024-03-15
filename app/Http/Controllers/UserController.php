<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id) {
        $user = User::findOrFail($id);
        return view("users.show", compact("user"));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view("users.edit", compact("user"));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        if(!empty($validatedData['password'])){
            $user->password = bcrypt($validatedData['password']);            
        }        
        $user->update($validatedData);
        return redirect()->route('users.show')
            ->with('success','User updated successfully');
    }
}
