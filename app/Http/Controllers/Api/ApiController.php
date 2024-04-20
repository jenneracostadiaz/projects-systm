<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;


class ApiController extends Controller
{
    // Register, Login, Profile, logout
    public function register(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors(),
                ], 401);
            }
    
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $token = $user->createToken('API TOKEN')->plainTextToken;
    
            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 401);
        }
    }

    public function login(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors(),
                ], 401);
            }
    
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }
    
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('API TOKEN')->plainTextToken;
    
            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 401);
        }
    }


    public function profile(){
        $userData = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'User profile',
            'data' => $userData,
            'id' => $userData->id,
        ], 200);
    }

    public function logout(){        
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully',
            'data' => []
        ], 200);
    }
}