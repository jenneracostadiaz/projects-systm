<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    private function data($user)
    {
        return [
            'user' => $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ];
    }

    public function register(RegisterRequest $request)
    {
        try
        {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $data = $this->data($user);
            return $this->getResponse(true, 'User registered successfully', $data);
        } catch (\Throwable $th) {
            return $this->getResponse(false, $th->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try{
            $user = User::where('email', $request->email)->first();
            $data = $this->data($user);
            return $this->getResponse(true, 'User logged in successfully', $data);
        } catch (\Throwable $th) {
            return $this->getResponse(false, $th->getMessage());
        }
    }

    public function profile()
    {
        try{
            $user = Auth::user();
            return $this->getResponse(true, 'User profile', $user);
        } catch (\Throwable $th) {
            return $this->getResponse(false, $th->getMessage());
        }
    }

    public function logout()
    {
        try{
            Auth::user()->tokens()->delete();
            return $this->getResponse(true, 'User logged out successfully');
        } catch (\Throwable $th) {
            return $this->getResponse(false, $th->getMessage());
        }
    }
    
}
