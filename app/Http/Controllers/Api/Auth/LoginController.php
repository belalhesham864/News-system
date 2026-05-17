<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50|exists:users,email',
            'password' => 'required|max:50'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return apiResponse(401, 'Invalid credentials');
        }
        if (!Hash::check($request->password, $user->password)) {
            return apiResponse(401, ['message' => 'Invalid credentials']);
        }
        $token = $user->createToken('user-token',[],now()->addMinutes(60))->plainTextToken;
        return apiResponse(200, 'Sucess Login', ['token' => $token]);
    }
    public function logout()
    {
        $user=request()->user();
        $user->currentAccessToken()->delete();
        return apiResponse(200,'Logout Successfuly');
    }
}
