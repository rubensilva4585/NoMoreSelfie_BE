<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            return response()->json(User::all(), 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        try {
            $user = User::create($request->all());
            return response()->json($user, 201);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try
        {
            return response()->json($user, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->profile()->update($request->only(['role', 'bio']));  // teste

        try
        {
            $user->update($request->all());
            return response()->json($user, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try
        {
            $user->delete();
            return response()->json(['message' => 'Deleted'], 205);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }
}
