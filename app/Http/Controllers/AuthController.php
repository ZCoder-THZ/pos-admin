<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken,
                ]);
            } else {
                return response()->json([
                    'message' => 'invalid password',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'there is no user',
            ]);
        }
    }
    //
    public function register(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ];
        User::create($data);
        $user = User::latest()->first();
        return response()->json([
            'token' => $user->createToken(time())->plainTextToken,
            'user' => $user,
        ]);
    }
}
