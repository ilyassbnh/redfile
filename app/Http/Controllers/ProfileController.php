<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request) {
        return response()->json($request->user());
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $request->user()->update($request->only(['name', 'email']));

        return response()->json(['success' => 'Profile updated successfully.']);
    }
}

