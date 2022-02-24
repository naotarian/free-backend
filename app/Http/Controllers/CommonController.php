<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function user_state(Request $request) {
        $check = Auth::user();
        \Log::info($request);
        $check = $request->user();
        \Log::info($check);
        $res = [
            'code' => '200',
            'content' =>$check,
            ];
        return response($res);
    }
}
