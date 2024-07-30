<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'mobile' => 'required|string|digits:10'
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

        try {
            if (User::where('email', $request->email)->exists()) {
                return response([
                    'message' => 'User already exists',
                    'status' => false,
                    'data' => null,
                    'error_code' => true,
                    'error_message' => 'User already exists'
                ], 200);
            }

            $otp = rand(100000, 999999);

            $user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'otp' => $otp,
                'password' => Hash::make($request->password),
            ]);

          

            $token = $user->createToken($request->email)->plainTextToken;

            // TODO: Send OTP to user's email  using php mailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rupjyotisarma706@gmail.com';
            $mail->Password = 'urnj afku yobx wuek';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('no-reply@example.com', 'One Pay');
            $mail->addAddress($user->email, $user->name);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP: ' . $otp;
            $mail->Body = 'Hello,' . $user->name . 'Your OTP is: ' . $otp;

            $mail->send();



            $response = [
                'message' => 'OTP has been sent to your email address.',
                'status' => true,
                'token' => $token,
                'token_type' => 'bearer',
                'error_code' => false,
                'error_message' => null
            ];
            return response($response, 201);
        } catch (\Exception $e) {
            // Handle any exceptions 
            $response = [
                'message' => 'Failed to send the OTP',
                'status' => false,
                'data' => null,
                'error_code' => true,
                'error_message' => $e->getMessage(),
            ];
            return response($response, 500);
        }
    }
}
