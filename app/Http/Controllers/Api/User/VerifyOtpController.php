<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerifyOtpController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        // Check if validation fails
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'error_message' => $validation->errors(),
                'error_Code' => true,
                'data' => null
            ], 422);
        }


        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $response = [
                'message' => 'User not found',
                'status' => false,
                'data' => null,
                'error_code' => true,
                'error_message' => 'User not found'
            ];
            return response()->json($response, 404);
        }

        // Check if the provided OTP matches the OTP stored in the user's record
        if ($user->otp == $request->otp) {
            // Update user verification status to indicate that OTP is verified
            $user->is_verified = 1;
            $user->save();


            $response = [
                'status' => true,
                'message' => 'OTP verification successful',
                'data' => $user,
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Invalid OTP',
                'error_code' => true,
                'error_message' => "Invalid OTP",
                'data' => null
            ];
            return response()->json($response, 401);
        }
    }
}
