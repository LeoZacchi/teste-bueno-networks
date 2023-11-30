<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $token = $request->input('token');

    if ($token) {

        $user = Auth::user();

        if ($user) {
            $user->device_token = $token;
            $user->save();

            return response()->json(['message' => 'Token saved successfully']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    return response()->json(['error' => 'Token not provided'], 400);
    }
}
