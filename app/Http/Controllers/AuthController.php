<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return [
                "message" => __("message.successfullyLogin")
            ];
        }

        return response()->json(["message" => "Unauthorized"], 401);
    }

    public function register(Request $request)
    {
        $input = $request->only('email', 'password', 'name');

        $user = new User();
        $user->email = $input["email"];
        $user->password = bcrypt($input["password"]);
        $user->name = $input["name"];
        $user->save();

        return response()->json(["message" => "Berhasil Registrasi"]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(["message" => "Berhasil Logout"]);
    }

    public function check()
    {
        $checkIsLogin = Auth::check();
        return response()->json(["is_login" => $checkIsLogin]);
    }
}
