<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Admin\AdminResource;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(Auth::guard('admin')->attempt($request->validated()))
        {
            $admin = Auth::user();

            $token = $admin->createToken('admin_token');

            return response()->json([
                'message' => __('messages.response.ok'),
                'admin' => new AdminResource($admin),
                'token' => $token->plainTextToken,
                'token_type' => 'Bearer'
            ], 200);
        }

        return response()->json([
            'message' => __('validation.login.fail'),
        ], 422);
    }

    public function check()
    {
        $admin = Auth::user();

        return response()->json([
            'message' => __('messages.response.ok'),
            'admin' => new UserResource($admin),
        ]);
    }


    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => __('messages.response.ok'),
        ]);
    }
}
