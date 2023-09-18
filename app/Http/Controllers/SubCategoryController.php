<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(SubCategory::all(), 200);
            } catch (Exception $exception) {
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
    public function store(StoreSubCategoryRequest $request)
    {
        $district = SubCategory::create($request->all());
        return response()->json($district, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        try
        {
            return response()->json($subCategory, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        try
        {
            $subCategory->update($request->all());
            return response()->json($subCategory, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        try
        {
            $subCategory->delete();
            return response()->json(['message' => 'Deleted'], 205);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }
}
