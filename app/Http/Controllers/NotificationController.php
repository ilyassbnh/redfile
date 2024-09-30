<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() {
        // Assuming you have a Notification model
        $notifications = Notification::all();
        return response()->json($notifications);
    }

    public function send(Request $request) {
        $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        // Logic for sending notification, e.g., saving to database
        Notification::create([
            'message' => $request->message,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['success' => 'Notification sent successfully.']);
    }
}

