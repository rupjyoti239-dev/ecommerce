<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Check if validation fails
            if ($validation->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'error_message' => $validation->errors(),
                    'error_Code' => true
                ], 422);
            }

            // Retrieve the user by email
            $user = User::where('email', $request->email)->first();

            // Check if user exists and password is correct
            if ($user && Hash::check($request->password, $user->password)) {
                // Check if the user is verified
                if ($user->is_verified == 1) {
                    // User is verified, generate token
                    $token = $user->createToken($request->email)->plainTextToken;
                    return response([
                        'message' => 'Login successful',
                        'status' => true,
                        'token' => $token,
                        'token_type' => 'bearer',
                        'data' => $user,
                        'error_code' => false,
                        'error_message' => null
                    ], 200);
                } else {
                    // User is not verified
                    return response([
                        'message' => 'Account not verified. Please verify your email address.',
                        'status' => false,
                        'data' => null,
                        'error_code' => true,
                        'error_message' => 'Account not verified'
                    ], 401);
                }
            }

            // Invalid email or password
            return response([
                'message' => 'Invalid email or password',
                'status' => false,
                'data' => null,
                'error_code' => true,
                'error_message' => 'Invalied email or Password'
            ], 401);
        } catch (QueryException $e) {
            // Database query exception
            return response([
                'status' => false,
                'message' => 'Failed to login. Please try again later.',
                'data' => null,
                'error_code' => true,
                'error_message' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            // Other exceptions
            return response([
                'status' => false,
                'message' => 'Failed to login. Please try again later.',
                'data' => null,
                'error_code' => true,
                'error_message' => $e->getMessage()
            ], 500);
        }
    }
}
