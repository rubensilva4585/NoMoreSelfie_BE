<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Category;
use App\Models\District;
use App\Http\Controllers\Controller;
use DB;
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

        return response()->json($formattedCategories);
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:profiles,id',
            'name' => 'required|string',
            'email' => 'required_without:phone|string|email',
            'phone' => 'required_without:email|string|max:16',
            'description' => 'required|nullable|string',
        ]);
        //$user = User::findOrFail($request->supplier_id);
        // $supplierProfile = \App\Models\User::where('id', $request->supplier_id)
        //     ->where('role', 'supplier')
        //     ->first();

        // if (!$supplierProfile) {
        //     return response()->json(['error' => 'Not Supplier Profile.'], 400);
        // }

        $newRequest = new \App\Models\Request([
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
        ]);

        $newRequest->save();

        return response()->json(['message' => 'Request Success', 'request' => $newRequest]);
    }

    public function getUserInfo($id)
    {

        $user = User::findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role,
            'email' => $user->email,
            'phone' => $user->phone,
            'dob' => $user->dob,
            'company' => optional($user->profile)->company,
            'nif' => optional($user->profile)->nif,
            'address' => optional($user->profile)->address,
            'bio' => optional($user->profile)->bio,
            'service_description' => optional($user->profile)->service_description,
            'avatar' => optional($user->profile)->avatar,
            'district' => optional($user->profile)->district ? optional($user->profile)->district->only(['id', 'name']) : null,
            'social' => [
                'website' => optional($user->social)->website,
                'facebook' => optional($user->social)->facebook,
                'instagram' => optional($user->social)->instagram,
                'linkedin' => optional($user->social)->linkedin,
                'pinterest' => optional($user->social)->pinterest,
            ],
        ]);
    }

    public function getSupplierServices($id)
    {
        $user = User::findOrFail($id);

        $services = $user->userSubCategory->groupBy(function ($service) {
            return $service->subCategory->category->id;
        })->map(function ($subcategories, $categoryId) {
            $category = Category::find($categoryId);
            return [
                'category_id' => $category->id,
                'category_name' => $category->name,
                'subcategories' => $subcategories->map(function ($subcategory) {
                    return [
                        'id' => $subcategory->subCategory->id,
                        'name' => $subcategory->subCategory->name,
                        'startPrice' => $subcategory->startPrice,
                        'endPrice' => $subcategory->endPrice,
                    ];
                })
            ];
        });

        return response()->json($services->values());
    }

    public function getSupplierImages($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user->images, 200);
    }

    public function getSupplierDistricts($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user->districts, 200);
    }




    public function getValidSuppliersList()
    {
        $suppliers = User::where('role', 'supplier')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->join('districts', 'profiles.district_id', '=', 'districts.id')
            ->whereNotNull('users.dob')
            ->whereNotNull('users.phone')
            ->whereNotNull('profiles.district_id')
            ->whereNotNull('profiles.company')
            ->whereNotNull('profiles.nif')
            ->whereNotNull('profiles.bio')
            ->whereNotNull('profiles.service_description')
            ->whereNotNull('profiles.avatar')
            ->where('profiles.verified', true)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('images')
                    ->whereRaw('images.user_id = users.id');
            })
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('user_sub_categories')
                    ->whereRaw('user_sub_categories.user_id = users.id');
            })
            ->with('images', 'districts:id,name')
            ->select(
                'users.id',
                'users.name',
                'users.dob',
                'districts.name as district_name',
                'profiles.company',
                'profiles.avatar'
            )
            ->get();

        // Estrutura de resposta
        $responseData = [];

        foreach ($suppliers as $supplier) {
            $supplierData = $supplier->toArray();
            $services = [];

            foreach ($supplier->userSubCategory as $userSubCategory) {
                $subcategory = $userSubCategory->subCategory;
                $category = $subcategory->category;

                if (!isset($services[$category->id])) {
                    $services[$category->id] = [
                        'category_id' => $category->id,
                        'category_name' => $category->name,
                        'subcategories' => [],
                    ];
                }

                $services[$category->id]['subcategories'][] = [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                    'startPrice' => $userSubCategory->startPrice,
                    'endPrice' => $userSubCategory->endPrice,
                ];
            }

            $imagePaths = $supplier->images->pluck('path');
            $supplierData['images'] = $imagePaths;

            $supplierData['services'] = array_values($services);

            $responseData[] = $supplierData;
        }

        return response()->json($responseData);
    }
}

            // ->whereExists(function ($query) {
            //     $query->select(DB::raw(1))
            //         ->from('sub_categories')
            //         ->whereRaw('sub_categories.user_id = users.id')
            //         ->whereExists(function ($query) {
            //             $query->select(DB::raw(1))
            //                 ->from('categories')
            //                 ->whereRaw('categories.id = sub_categories.category_id')
            //                 ->where('categories.inPerson', true);
            //         });
            // })
