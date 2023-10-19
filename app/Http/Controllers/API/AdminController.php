<?php

namespace App\Http\Controllers\API;

// use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function adminCheck(UpdateUserRequest $request) {

        $user = Auth::user();

        if ($user && $user->profile && $user->profile->role == 'admin') {

            $user->update($request->all());
            return response()->json($user, 200);

        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
