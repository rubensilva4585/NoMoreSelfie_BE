<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Models\Client;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            return response()->json(Request::all(), 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestRequest $request)
    {
        $district = Request::create($request->all());
        return response()->json($district, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try
        {
            return response()->json($request, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestRequest $updateRequest, Request $request)
    {

        try
        {
            $request->update($updateRequest->all());
            return response()->json($request, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try
        {
            $request->delete();
            return response()->json(['message' => 'Deleted'], 205);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }
}
