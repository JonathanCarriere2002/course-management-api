<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Resources\UserResources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Voir https://laravel.com/docs/10.x/sanctum#spa-configuration
 */
class APIAuthController extends BaseController
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string','max:255'],
            'device_name' => ['string', 'max:255'],
        ]);
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->sendError(['email' => ['The provided credentials are incorrect.']]);
        }
        $data = [
            'user' => new UserResource($user),
            'token' => $user->createToken($request->device_name ?: env('APP_NAME'))->plainTextToken
        ];
        return $this->sendResponse($data);
    }

    public function logout(Request $request): JsonResponse
    {
        if(auth()->user()->tokens()){
            auth()->user()->tokens()->delete();
        }
        return $this->sendResponse('logout');
    }
}
