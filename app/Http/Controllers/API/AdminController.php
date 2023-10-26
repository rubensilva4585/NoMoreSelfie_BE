<?php

namespace App\Http\Controllers\API;

// use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Models\Profile;
use App\Models\User;

class AdminController extends Controller
{
    public function adminCheck(UpdateUserRequest $request)
    {

        $user = Auth::user();

        if ($user && $user->profile && $user->profile->role == 'admin') {

            $user->update($request->all());
            return response()->json($user, 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    public function getrequests($supplierId)
    {
        if (Auth::user()->profile->role !== 'admin') {
            return response()->json(['error' => 'Only Admin can access.'], 403);
        }

        $requests = Request::where('supplier_id', $supplierId)->get();

        return response()->json(['requests' => $requests]);
    }

    public function getSuppliersList()
    {
        if (Auth::user()->profile->role !== 'admin') {
            return response()->json(['error' => 'Only Admin can access.'], 403);
        }

        $suppliers = User::join('profiles', 'users.id', '=', 'profiles.user_id')
            ->where('profiles.role', 'supplier')
            ->get();

        return response()->json($suppliers);
    }
}
