<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit() {
        return view('user.profile.edit');
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $request->user()->update($request->all());
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
