<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Sign Up untuk user baru
     */
    public function signup(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru dengan hash password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Buat token API untuk user
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'User berhasil didaftarkan',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Login untuk user yang sudah ada
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Buat token API
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Login berhasil',
                'user' => $user,
                'token' => $token
            ], 200);
        }

        // Gagal login
        return response()->json([
            'message' => 'Kredensial tidak valid'
        ], 401);
    }
}

