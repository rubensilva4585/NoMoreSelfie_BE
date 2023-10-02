<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\UserSubCategory;
use Illuminate\Http\Request;
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
            $userSubCategory = UserSubCategory::create($request->all());
            return response()->json($userSubCategory, 201);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id, $subcategory_id)
    {
        try
        {
            $userSubCategory = UserSubCategory::where('user_id', $user_id)
            ->where('subcategory_id', $subcategory_id)
            ->first();

            if (!$userSubCategory) {
                return response()->json(['message' => 'UserSubCategory not found'], 404);
            }

            return response()->json($userSubCategory, 200);
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
            $userSubCategory = UserSubCategory::where('user_id', $request->user_id)
            ->where('subcategory_id', $request->subcategory_id);

            $userSubCategory->update($request->all());
            return response()->json($userSubCategory, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id, $subcategory_id)
    {
        try
        {
            $userSubCategory = UserSubCategory::where('user_id', $user_id)
                ->where('subcategory_id', $subcategory_id);

            if (!$userSubCategory) {
                return response()->json(['message' => 'UserSubCategory not found'], 404);
            }

            $userSubCategory->delete();

            return response()->json(['message' => 'Deleted'], 204);

        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
