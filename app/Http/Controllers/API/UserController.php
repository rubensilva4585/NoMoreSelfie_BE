<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function updateUser(Request $request)
    {

        $user = Auth::user();

        $user->update($request->only(['name']));
        $user->profile()->update($request->only(['phone', 'company', 'nif', 'dob', 'address', 'bio']));
        return response()->json(['data' => Auth::user(), 'message' => 'Update successfull'], 200);
    }

    public function changePassword(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'oldpassword' => 'required|string|min:6',
            'newpassword' => 'required|string|min:6',
        ]);

        if (!Hash::check($request->input('oldpassword'), $user->password)) {
            return response()->json(['error' => 'Invalid password'], 401);
        }

        if (Hash::check($request->newpassword, $user->password)) {
            return response()->json(['error' => 'New password cannot be the same as your current password.'], 400);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return response()->json(['message' => 'Password changed successfully']);
    }
}
