<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response([
            'status' => true,
            'message' => 'logout successful',
            'error_code' => false,
            'error_message' => null
        ], 200);
    }
}
