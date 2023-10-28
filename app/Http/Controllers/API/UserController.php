<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\UserSubCategory;
use Storage;
use Str;
use App\Models\Request as RequestModel;


class UserController extends Controller
{
    public function getLoggedUserInfo()
    {
        $user = Auth::user();

        if ($user) {
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
                'isVerified' => optional($user->profile)->verified,
                'social' => [
                    'website' => optional($user->social)->website,
                    'facebook' => optional($user->social)->facebook,
                    'instagram' => optional($user->social)->instagram,
                    'linkedin' => optional($user->social)->linkedin,
                    'pinterest' => optional($user->social)->pinterest,
                ],
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();

        $user->update($request->only(['name', 'email', 'phone', 'dob']));
        if ($user->role == 'supplier') {
            $user->profile()->update($request->only(['company', 'nif', 'bio', 'service_description', 'district_id']));
            $user->social()->update($request->only(['website', 'facebook', 'instagram', 'linkedin', 'pinterest']));
        }

        $userData = [
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
            'isVerified' => optional($user->profile)->verified,
            'social' => [
                'website' => optional($user->social)->website,
                'facebook' => optional($user->social)->facebook,
                'instagram' => optional($user->social)->instagram,
                'linkedin' => optional($user->social)->linkedin,
                'pinterest' => optional($user->social)->pinterest,
            ],
        ];

        return response()->json(['user' => $userData, 'message' => 'Update successfull'], 200);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'oldpassword' => 'required|string|min:6',
            'newpassword' => 'required|string|min:6',
        ]);

        if (!Hash::check($request->input('oldpassword'), $user->password)) {
            return response()->json(['error' => 'Password atual invalida'], 401);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return response()->json(['message' => 'Password changed successfully']);
    }

    public function deleteUserAccount()
    {
        $user = Auth::user();

        try {
            $user->delete();
            return response()->json(['message' => 'Deleted'], 205);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }


    // Requested Services
    public function getSupplierRequests()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Not authenticated user.'], 401);
        }

        if ($user->role !== 'supplier') {
            return response()->json(['error' => 'Only suppliers can access.'], 403);
        }

        $requests = RequestModel::where('supplier_id', $user->id)->get();

        return response()->json($requests, 200);
    }


    // Portfolio Images
    public function setSupplierImages(Request $request)
    {
        $user = Auth::user();

        $existingImageCount = $user->images->count();
        $newImageCount = count($request->file('images'));
        if ($existingImageCount + $newImageCount > 10) {
            return response()->json(['error' => 'Limite 10 imagens por usuario!'], 400);
        }

        $publicStorage = Storage::disk('public');

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $imageName = $user->id . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $publicStorage->putFileAs('images/' . $user->id, $image, $imageName);

                $imageModel = new Image(['path' => $path]);
                $user->images()->save($imageModel);
            }

            return response()->json(['message' => 'Imagens salvas com sucesso', 'images' => $user->images], 201);
        }

        return response()->json(['message' => 'Nenhuma imagem foi enviada'], 400);
    }

    public function removeSupplierImage($imageId)
    {
        $user = Auth::user();
        $image = $user->images()->find($imageId);

        if (!$image) {
            return response()->json(['error' => 'Imagem não encontrada'], 404);
        }

        Storage::disk('public')->delete($image->path);

        $image->delete();

        return response()->json(['message' => 'Imagem removida com sucesso'], 200);
    }

    public function getSupplierImages()
    {
        $user = Auth::user();
        return response()->json($user->images, 200);
    }


    // Profile Picture
    public function updateProfileImage(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $publicStorage = Storage::disk('public');

            if ($user->profile->avatar) {
                $publicStorage->delete($user->profile->avatar);
            }

            $image = $request->file('avatar');
            $imageName = $user->id . '_' . Str::random(10) . '_avatar.' . $image->getClientOriginalExtension();
            $path = $image->storeAs("images/{$user->id}/avatar", $imageName, 'public');

            $user->profile->avatar = $path;
            $user->profile->save();

            return response()->json(['message' => 'Imagem de perfil atualizada com sucesso', 'avatar' => $path], 201);
        }

        return response()->json(['message' => 'Nenhuma imagem foi enviada'], 400);
    }

    public function removeProfileImage()
    {
        $user = Auth::user();
        $publicStorage = Storage::disk('public');

        if ($user->profile->avatar) {
            $publicStorage->delete($user->profile->avatar);

            $user->profile->avatar = null;
            $user->profile->save();

            return response()->json(['message' => 'Imagem de perfil removida com sucesso'], 200);
        }

        return response()->json(['message' => 'Nenhuma imagem de perfil para remover'], 404);
    }

    public function updateUserDistricts(Request $request)
    {
        $user = Auth::user();
        $districtIds = $request->input('district_ids');

        $user->districts()->sync($districtIds);

        return response()->json(['message' => 'Distritos atualizados com sucesso']);
    }

    public function getSupplierDistricts()
    {
        $user = Auth::user();
        return response()->json($user->districts, 200);
    }

    public function getSupplierServices()
    {
        $user = Auth::user();

        $services = $user->userSubCategory->groupBy(function ($service) {
            return $service->subCategory->category->id;
        })->map(function ($subcategories, $categoryId) {
            $category = Category::find($categoryId);
            return [
                'id' => $category->id,
                'name' => $category->name,
                'inPerson' => $category->inPerson,
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

    public function updateSupplierServices(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $userSubCategories = UserSubCategory::where('user_id', $user->id)->get();
        $userSubCategoryIds = $userSubCategories->pluck('subcategory_id')->toArray();

        foreach ($data as $category) {
            foreach ($category['subcategories'] as $subcategory) {
                $subcategoryId = $subcategory['id'];

                UserSubCategory::updateOrInsert(
                    [
                        'user_id' => $user->id,
                        'subcategory_id' => $subcategoryId,
                    ],
                    [
                        'startPrice' => $subcategory['startPrice'],
                        'endPrice' => $subcategory['endPrice'],
                    ]
                );
                if (($key = array_search($subcategoryId, $userSubCategoryIds)) !== false) {
                    unset($userSubCategoryIds[$key]);
                }
            }
        }
        UserSubCategory::where('user_id', $user->id)
            ->whereIn('subcategory_id', $userSubCategoryIds)
            ->delete();

        return response()->json(['message' => 'Dados atualizados com sucesso']);
    }

    public function addUserFavorite(Request $request)
    {
        $user = Auth::user();
        $supplierId = $request->input('supplier_id');

        $user->favoriteSuppliers()->attach($supplierId);

        return response()->json(['message' => 'Favorito adicionado com sucesso']);
    }

    public function removeUserFavorite(Request $request)
    {
        $user = Auth::user();
        $supplierId = $request->input('supplier_id');

        $user->favoriteSuppliers()->detach($supplierId);

        return response()->json(['message' => 'Favorito removido com sucesso']);
    }

    public function getUserFavorites()
    {
        $user = Auth::user();
        $favoriteSuppliers = $user->favoriteSuppliers;
        return response()->json($favoriteSuppliers);
    }
}
