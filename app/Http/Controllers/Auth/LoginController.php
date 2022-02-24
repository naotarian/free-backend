<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return response()->json(['name' => Auth::user()->email, 'msg' => 'OK'] , 200);
    //     }
    //     $res = ['msg' => 'メールアドレス又はパスワードが間違っています。'];
    //     return response()->json($res, 200);
    // }
    // public function logout(Request $request)
    // {
    //     Auth::guard('web')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     $res = ['msg' => 'ログアウトしました'];
    //     return response()->json($res);
    // }
}
