<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Check if validation fails
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'data' => null,
                'error_message' => $validation->errors(),
                'error_Code' => true
            ], 422);
        }

        $user = Auth::user();


        if (!Hash::check($request->current_password, $user->password)) {
            $response = [
                'status' => false,
                'message' => 'The provided current password is incorrect.',
                'error_code' => true,
                'error_message' => "The provided current password is incorrect.",
                'data' => null
            ];
            return response()->json($response, 422);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();
        $response = [
            'status' => true,
            'message' => 'Password Changed Successfully',
            'error_message' => null,
            'error_Code' => false
        ];
        return response()->json($response, 200);
    }
}
