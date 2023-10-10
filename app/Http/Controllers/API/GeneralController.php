<?php

namespace App\Http\Controllers\API;

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

    public function getCategory($categoryId)
    {
        $category = Category::find($categoryId);

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
}