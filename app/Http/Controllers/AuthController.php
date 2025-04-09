<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::debug('Validation failed during login', $validator->errors()->toArray());
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Attempt to retrieve the user by username
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            Log::debug("Login failed: User not found for username: {$request->username}");
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Verify password using Laravel's built-in hashing
        if (!Hash::check($request->password, $user->password)) {
            Log::debug("Login failed: Incorrect password for username: {$request->username}");
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // (Optional) If using API token authentication, generate and return a token
        // $token = $user->createToken('auth_token')->plainTextToken;
        Log::debug("Login successful for username: {$request->username}");
        return response()->json([
            'message' => 'Login successful',
            'user'    => $user,
            // 'token'   => $token,  // if token is generated
        ], 200);
    }
}
