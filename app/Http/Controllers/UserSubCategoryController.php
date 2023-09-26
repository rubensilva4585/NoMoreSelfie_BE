<?php

namespace App\Http\Controllers;

use App\Models\UserSubCategory;
use App\Http\Requests\StoreUserSubCategoryRequest;
use App\Http\Requests\UpdateUserSubCategoryRequest;

class UserSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            return response()->json(UserSubCategory::all(), 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserSubCategoryRequest $request)
    {
        try {
            $$userSubCategory = UserSubCategory::create($request->all());
            return response()->json($$userSubCategory, 201);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserSubCategory $userSubCategory)
    {
        try
        {
            return response()->json($$userSubCategory, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserSubCategoryRequest $request, UserSubCategory $userSubCategory)
    {
        try
        {
            $$userSubCategory->update($request->all());
            return response()->json($$userSubCategory, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSubCategory $userSubCategory)
    {
        try
        {
            $userSubCategory->delete();
            return response()->json(['message' => 'Deleted'], 205);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }
}
