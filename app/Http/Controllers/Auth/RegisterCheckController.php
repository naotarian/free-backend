<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\business_users;
use App\Models\general_users;
use App\Models\User;
use App\Models\Provisional_registration_token;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\MainRegisterMail;
use Illuminate\Support\Facades\Hash;

class RegisterCheckController extends Controller
{
    public function index(Request $request) {
        $datas = $request->all();
        $messages = [
            'email.unique' => 'メールアドレスは既に使用されています。',
        ];
        $validator = Validator::make($datas,[
            'email' => 'required|unique:users,email,40,id,deleted_at,NULL',
        ],$messages);
        
        if($validator->fails()){
            $res = ['code' => 400, 'msg' => '既に使用されているメールアドレスです。'];
            return response()->json($res);
        }
        $res = ['code' => 200, 'msg' => 'OK'];
        return response()->json($res);
    }
    //仮登録トークン保存処理
    public function post_token(Request $request) {
        $already_token = Provisional_registration_token::where('email', $request['email'])->first();
        if($already_token) {
            $already_token->delete();
        }
        $token = Str::random(64);
        $new_token = new Provisional_registration_token;
        $new_token->email = $request['email'];
        $new_token->password = Hash::make($request['password']);
        $new_token->user_name = $request['user_name'];
        $new_token->token = $token;
        $new_token->account_type = $request['accountType'];
        $new_token->save();
        $variables = [];
        $variables['url'] = config('app.front_url') . '/auth/main_registration/' . $token;
        Mail::to($request['email'])->send(new MainRegisterMail($variables,$token));
        $res = ['code' => 200, 'msg' => 'OK'];
        return response()->json($res);
    }
    //本登録処理
    public function main_register(Request $request) {
        $token_table_datas = Provisional_registration_token::where('token', $request['token'])->first();
        $token_table_array_datas = json_decode($token_table_datas, true);
        $user = User::create([
            'user_name' => $token_table_array_datas['user_name'],
            'email' => $token_table_array_datas['email'],
            'password' => $token_table_array_datas['password'],
            // 'password' => Hash::make($request['password']),
        ]);
         
        $token = $user->createToken('auth_token')->plainTextToken;
         
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function login(Request $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                                    'message' => 'Invalid login details'
                                    ], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'msg' => 'OK',
            // ''
        ]);
    }
    public function me(Request $request) {
        return response($request->user())->header('Cache-Control', 'public');
    }
}
