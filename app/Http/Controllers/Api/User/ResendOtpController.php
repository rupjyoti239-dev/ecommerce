<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;

class ResendOtpController extends Controller
{
    public function resendOtp(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
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

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $response = [
                'message' => 'User not found',
                'status' => false,
                'data' => null,
                'error_code' => true,
                'error_message' => 'user not found'
            ];
            return response()->json($response, 404);
        }

        // Generate a new OTP
        $otp = rand(100000, 999999);

        // Attempt to send OTP email
        try {

            //    TODO: new OTP to user's email using PHPMailer  
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
            $mail->Body = 'Your OTP is: ' . $otp;

            $mail->send();


            // Update user's OTP in the database
            $user->otp = $otp;
            $user->save();

            $response = [
                'message' => 'OTP has been resent to your email address.',
                'status' => true,
                'error_code' => false,
                'error_message' => null
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            // Email sending failed
            $response = [
                'message' => 'Failed to resend OTP. Please try again later.',
                'status' => false,
                'data' => null,
                'error_message' => $e->getMessage(),
                'error_code' => true
            ];
            return response()->json($response, 500);
        }
    }
}
