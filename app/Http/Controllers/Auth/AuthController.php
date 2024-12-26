<?php

namespace App\Http\Controllers\Auth;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $record = DB::table('admin')->where([
            'email' => $request->txt_email,
            'password' => Hash::check($request->txt_password, Hash::make($request->txt_password))
        ]);
        if ($record) {
            Session::put(
                [
                    'username' => $request->txt_email,
                    'id' => 1,
                    'name' => 'Abhishek'
                ]

            );
            return redirect()->route('admin-dashboard');
        }
    }
    public function loginPage()
    {
        return view('Auth.login');
    }

    public function adminDashboard()
    {
        return view('layouts.main-layout');
    }

    public function logOut()
    {
        // Session::logout();
        Session::invalidate();
        Session::flush();
        return redirect('login');
    }
}
