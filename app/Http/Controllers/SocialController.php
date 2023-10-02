<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Social;
use App\Http\Requests\StoreSocialRequest;
use App\Http\Requests\UpdateSocialRequest;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            return response()->json(Social::all(), 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialRequest $request)
    {
        $social = Social::create($request->all());
        return response()->json($social, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        try
        {
            return response()->json($social, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialRequest $request, Social $social)
    {
        try
        {
            $social->update($request->all());
            return response()->json($social, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Social $social)
    {
        try
        {
            $social->delete();
            return response()->json(['message' => 'Deleted'], 205);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }
}
