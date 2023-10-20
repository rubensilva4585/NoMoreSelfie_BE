<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Category;
use App\Models\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getAllDistricts()
    {
        $districts = District::select('id', 'name')->get();
        return response()->json($districts);
    }

    public function getCategory(Category $category)
    {
        if ($category) {
            $categoryData = $category->only(['id', 'name', 'inPerson']);
            $subCategoriesData = $category->subCategory->map->only(['id', 'name']);

            $response = [
                'category' => $categoryData,
                'subcategories' => $subCategoriesData,
            ];

            return response()->json($response);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }

    }

    public function getAllCategories()
    {
        $categories = Category::with('subCategory')->get();

        $formattedCategories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'inPerson' => $category->inPerson,
                'subcategories' => $category->subCategory->map->only(['id', 'name'])
            ];
        });

        return response()->json(['categories' => $formattedCategories]);
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:profiles,id',
            'name' => 'required|string',
            'email' => 'required_without:phone|email',
            'phone' => 'required_without:email|string|max:16',
            'description' => 'nullable|string',
        ]);
        $supplierProfile = \App\Models\Profile::where('id', $request->supplier_id)
            ->where('role', 'supplier')
            ->first();

        if (!$supplierProfile) {
            return response()->json(['error' => 'Not Supplier Profile".'], 400);
        }

        $newRequest = new \App\Models\Request([
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'date' => now(),
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
        ]);
        
        $newRequest->save();

        return response()->json(['message' => 'Request Success', 'request' => $newRequest]);
    }

    public function getUserInfo($id) {

        $user = User::findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'company' => $user->profile->company,
            'nif' => $user->profile->nif,
            'dob' => $user->profile->dob,
            'address' => $user->profile->address,
            'bio' => $user->profile->bio,  
            'social' => [
                'website' => optional($user->social)->website,
                'facebook' => optional($user->social)->facebook,
                'instagram' => optional($user->social)->instagram,
                'linkedin' => optional($user->social)->linkedin,
                'pinterest' => optional($user->social)->pinterest,
            ],
        ]);
    }
}
