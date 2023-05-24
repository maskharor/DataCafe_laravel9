<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\petugas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $token = Str::random(100);

        $user = petugas::where('username', $request->input('username'))->first();
        
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json(['message' => 'Password mu salah oi'], 401);
        }


        $role = $user->role;

        return response()->json(compact('token', 'role'));
    }
}
