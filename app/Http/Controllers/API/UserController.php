<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserSubCategory;

class UserController extends Controller
{
    public function updateUser(Request $request)
    {
        $user = Auth::user();

        $user->update($request->only(['name']));
        $user->profile()->update($request->only(['phone', 'company', 'nif', 'dob', 'address', 'bio']));
        $user->social()->update($request->only(['website', 'facebook', 'instagram', 'linkedin', 'pinterest']));

        $data = [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'company' => $user->profile->company,
            'nif' => $user->profile->nif,
            'dob' => $user->profile->dob,
            'address' => $user->profile->address,
            'bio' => $user->profile->bio,
            'website' => $user->social->website,
            'facebook' => $user->social->facebook,
            'instagram' => $user->social->instagram,
            'linkedin' => $user->social->linkedin,
            'pinterest' => $user->social->pinterest,
        ];

        return response()->json(['data' => $data, 'message' => 'Update successfull'], 200);
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

    public function getLoggedUserRequests() // testar
    {
        $user = Auth::user();

        if ($user->profile->role !== 'supplier') {
            return response()->json(['error' => 'Only suppliers can access.'], 403);
        }

        $requests = Request::where('supplier_id', $user->profile->id)->get();

        return response()->json(['requests' => $requests]);
    }

    public function getLoggedUserInfo() {

        $user = Auth::user();

        if ($user) {
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'company' => $user->profile->company,
                'nif' => $user->profile->nif,
                'dob' => $user->profile->dob,
                'address' => $user->profile->address,
                'bio' => $user->profile->bio,
                'social' =>[
                    'website' => optional($user->social)->website,
                    'facebook' => optional($user->social)->facebook,
                    'instagram' => optional($user->social)->instagram,
                    'linkedin' => optional($user->social)->linkedin,
                    'pinterest' => optional($user->social)->pinterest,
                ]
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    // public function getLoggedUserServices() // testar
    // {
    //     $user = Auth::user();

    //     if ($user->profile->role !== 'supplier') {
    //         return response()->json(['error' => 'Only suppliers can access.'], 403);
    //     }

    //     $services = UserSubCategory::where('user_id', $user->profile->id)->get();

    //     return response()->json(['services' => $services]);
    // }

}
