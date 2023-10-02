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
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $subCategory = SubCategory::create($request->all());
        return response()->json($subCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($subCategory_id)
    {
        try
        {
            $subCategory = SubCategory::where('id', $subCategory_id)
            ->first();

            if (!$subCategory) {
                return response()->json(['message' => 'SubCategory not found'], 404);
            }

            return response()->json($subCategory, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, $subCategory_id)
    {
        try
        {
            $subCategory = SubCategory::where('id', $subCategory_id)
            ->first();

            if (!$subCategory) {
                return response()->json(['message' => 'SubCategory not found'], 404);
            }

            $subCategory->update($request->all());
            
            return response()->json($subCategory, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($subCategory_id)
    {
        try
        {
            $subCategory = SubCategory::where('id', $subCategory_id)
            ->first();

            if (!$subCategory) {
                return response()->json(['message' => 'SubCategory not found'], 404);
            }

            $subCategory->delete();

            return response()->json(['message' => 'Deleted'], 204);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
