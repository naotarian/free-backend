<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\business_users;

class RegisterCheckController extends Controller
{
    public function index(Request $request) {
        $datas = $request->all();
        \Log::info($datas);
        
        $messages = [
            //'first_name.required' => '名前を入力してください',
            'email.unique' => 'メールアドレスは既に使用されています。',
        ];
        $validator = Validator::make($datas,[
            'email' => 'required|unique:business_users,email,40,id,deleted_at,NULL',
        ],$messages);
        
        if($validator->fails()){
            $res = ['code' => 400, 'msg' => '既に使用されているメールアドレスです。'];
            return response()->json($res);
            // return redirect()->route('register')->withErrors($validator)->withInput();
        }
        // $data = [];
        // $data['email'] = $request['email'];
        // \Log::info($request);
        $res = ['code' => 200, 'msg' => 'OK'];
        
        
        return response()->json($res);
    }
}
