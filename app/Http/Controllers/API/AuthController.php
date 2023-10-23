<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $user->load('profile');

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
                'social' => [
                    'website' => optional($user->social)->website,
                    'facebook' => optional($user->social)->facebook,
                    'instagram' => optional($user->social)->instagram,
                    'linkedin' => optional($user->social)->linkedin,
                    'pinterest' => optional($user->social)->pinterest,
                ],
            ];

            return response()->json([
                'message' => 'User login successfully',
                'user' => $userData,
                'authorization' => [
                    'token' => $user->createToken('ApiToken')->plainTextToken,
                    'type' => 'bearer',
                ]
            ]);
        }

        $userByEmail = User::where('email', $credentials['email'])->first();

        if (!$userByEmail) {
            return response()->json([
                'email' => 'Email inválido',
            ], 401);
        } else {
            return response()->json([
                'password' => 'Password incorreta',
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($request->role == 'supplier')
            $user->social()->create();

        $profileData = [
            'role' => $request->input('role', 'user'),
            'user_id' => $user->id,
            'district_id' => $request->input('district_id', null),
            'dob' => $request->input('dob', null),
            'phone' => $request->input('phone', null),
            'company' => $request->input('company', null),
            'nif' => $request->input('nif', null),
            'address' => $request->input('address', null),
            'bio' => $request->input('bio', null),
        ];

        $user->profile()->create($profileData);


        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $userAuth = Auth::user();
            $userAuth->load('profile');

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
                'social' => [
                    'website' => optional($user->social)->website,
                    'facebook' => optional($user->social)->facebook,
                    'instagram' => optional($user->social)->instagram,
                    'linkedin' => optional($user->social)->linkedin,
                    'pinterest' => optional($user->social)->pinterest,
                ],
            ];

            return response()->json([
                'message' => 'User created successfully',
                'user' => $userData,
                'authorization' => [
                    'token' => $userAuth->createToken('ApiToken')->plainTextToken,
                    'type' => 'bearer',
                ]
            ]);
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
