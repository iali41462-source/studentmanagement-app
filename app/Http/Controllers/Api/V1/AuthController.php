<?php

namespace App\Http\Controllers\Api\v1;
// namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginApiRequest;
use Illuminate\Http\Request;
// use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(LoginApiRequest $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {

            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials'
            ], 401);

        }
/** @var \App\Models\User $user */
$user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'token' => $token,
            'user' => $user
        ]);
    }
    public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'success' => true,
        'message' => 'Logout Successfully'
    ]);
}
}
