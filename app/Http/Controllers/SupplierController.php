<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use App\Models\District;
use App\Http\Requests\StoresupplierRequest;
use App\Http\Requests\UpdatesupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            return response()->json(Supplier::all(), 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresupplierRequest $request)
    {
        $district = District::findOrFail($request->input('id_district'));
        $supplier = new Supplier($request->all());
        $supplier->district()->associate($district);
        $supplier->save();

        return response()->json($supplier, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(supplier $supplier)
    {
        try
        {
            return response()->json($supplier, 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesupplierRequest $request, supplier $supplier)
    {
        try {
            $districtId = $request->input('id_district');
            $district = District::findOrFail($districtId);
            $supplier->update($request->all());
            $supplier->district()->associate($district);
            $supplier->save();

            return response()->json($supplier, 200);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(supplier $supplier)
    {
        try
        {
            $supplier->delete();
            return response()->json(['message' => 'Deleted'], 205);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception], 500);
        }
    }
}
