<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }


    public function adminLogin(Request $request, Guard $guard)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login.form')->with('error', 'Username or password incorrect');
    }


    public function logout(Request $request, Guard $guard)
    {
        $guard->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login.form');
    }



    public function changePassword()
    {
        return view('admin.change-password');
    }


    public function storePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Retrieve the currently authenticated admin user
        $admin = auth()->guard('admin')->user();

        // Check if the current password matches the one provided in the request
        if ($admin && Hash::check($request->current_password, $admin->password)) {
            // Update the admin user's password
            $admin->password = Hash::make($request->new_password);
            $admin->save();

            return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully');
        }

        return back()->with('error', 'Incorrect current password');
    }





    public function dashboard()
    {
        return view('admin.dashboard');
    }
}