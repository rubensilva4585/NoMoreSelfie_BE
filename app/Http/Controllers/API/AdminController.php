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

        if ($user && $user->role == 'admin') {

            $user->update($request->all());
            return response()->json($user, 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    public function getrequests($supplierId)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Only Admin can access.'], 403);
        }

        $requests = Request::where('supplier_id', $supplierId)->get();

        return response()->json(['requests' => $requests]);
    }

    public function getSuppliersList()
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Only Admin can access.'], 403);
        }

        $suppliers = User::where('role', 'supplier')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*', 'profiles.*')
            ->get();

        return response()->json($suppliers);
    }

    public function validateSupplier(Request $request, $supplierId)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Only Admin can access.'], 403);
        }

        $supplier = User::findOrFail($supplierId);
        if ($supplier->role !== 'supplier') {
            return response()->json(['error' => 'Esse user não é fornecedor'], 403);
        }

        $supplier->profile()->update(['verified' => !$supplier->profile->verified]);

        return response()->json(!$supplier->profile->verified);
    }
}
