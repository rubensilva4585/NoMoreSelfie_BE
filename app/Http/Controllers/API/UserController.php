<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                'role' => $user->profile->role,
                'email' => $user->email,
                'phone' => $user->profile->phone,
                'company' => $user->profile->company,
                'nif' => $user->profile->nif,
                'dob' => $user->profile->dob,
                'address' => $user->profile->address,
                'bio' => $user->profile->bio,
                'service_description' => $user->profile->service_description,
                'avatar' => $user->profile->avatar,
                'district' => $user->profile->district ? $user->profile->district->only(['id', 'name']) : null,
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

        $user->update($request->only(['name', 'email']));
        $user->profile()->update($request->only(['phone', 'company', 'nif', 'dob', 'address', 'bio', 'service_description', 'district_id']));
        $user->social()->update($request->only(['website', 'facebook', 'instagram', 'linkedin', 'pinterest']));

        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->profile->role,
            'email' => $user->email,
            'phone' => $user->profile->phone,
            'company' => $user->profile->company,
            'nif' => $user->profile->nif,
            'dob' => $user->profile->dob,
            'address' => $user->profile->address,
            'bio' => $user->profile->bio,
            'service_description' => $user->profile->service_description,
            'avatar' => $user->profile->avatar,
            'district' => $user->profile->district ? $user->profile->district->only(['id', 'name']) : null,
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

        if (!$user->profile) {
            return response()->json(['error' => 'Profile doesnt exist.'], 403);
        }

        if ($user->profile->role !== 'supplier') {
            return response()->json(['error' => 'Only suppliers can access.'], 403);
        }

        $requests = RequestModel::where('supplier_id', $user->profile->id)->get();

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
        // if (!$user) {
        //     return response()->json(['error' => 'Usuário não encontrado'], 404);
        // }
        return response()->json($user->images, 200);
    }


    // Profile Picture
    public function updateProfileImage(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // $request->validate([
            //     'avatar' => 'image|mimes:jpeg,png,jpg|max:2048', // Exemplo de regras de validação
            // ]);

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
}
