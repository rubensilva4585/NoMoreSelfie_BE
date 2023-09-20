<?php

namespace App\Http\Controllers;

use App\Models\Supplier_Category_SubCategory;
use App\Models\District;
use App\Http\Requests\StoreSupplier_Category_SubCategoryRequest;
use App\Http\Requests\UpdateSupplier_Category_SubCategoryRequest;

class SupplierCategorySubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            return response()->json(Supplier_Category_SubCategory::all(), 200);
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
    public function store(StoreSupplier_Category_SubCategoryRequest $request)
    {
        $supplier_Category_SubCategory = Supplier_Category_SubCategory::create($request->all());
        return response()->json($supplier_Category_SubCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier_Category_SubCategory $supplier_Category_SubCategory)
    {
        try
        {
            return response()->json($supplier_Category_SubCategory, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier_Category_SubCategory $supplier_Category_SubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplier_Category_SubCategoryRequest $request, Supplier_Category_SubCategory $supplier_Category_SubCategory)
    {
        try
        {
            $supplier_Category_SubCategory->update($request->all());
            return response()->json($supplier_Category_SubCategory, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier_Category_SubCategory $supplier_Category_SubCategory)
    {
        try
        {
            $supplier_Category_SubCategory->delete();
            return response()->json(['message' => 'Deleted'], 205);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }
}
