<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
                'token' => $token->plainTextToken,
                'token_type' => 'Bearer'
            ], 200);
        }

        return response()->json([
            'message' => __('validation.login.fail'),
        ], 422);
    }

    public function register(RegisterRequest $request)
    {
        $admin = Admin::create($request->validated());

        $token = $admin->createToken('admin_token');

        return response()->json([
            'message' => __('messages.response.ok'),
            'admin' => new AdminResource($admin),
            'token' => $token->plainTextToken,
            'token_type' => 'Bearer'
        ], 201);
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
