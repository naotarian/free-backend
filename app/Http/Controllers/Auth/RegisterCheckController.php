<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\business_users;
use App\Models\Provisional_registration_token;
use Illuminate\Support\Str;
use Mail;
use App\Mail\MainRegisterMail;

class RegisterCheckController extends Controller
{
    public function index(Request $request) {
        $datas = $request->all();
        $messages = [
            'email.unique' => 'メールアドレスは既に使用されています。',
        ];
        $validator = Validator::make($datas,[
            'email' => 'required|unique:business_users,email,40,id,deleted_at,NULL',
        ],$messages);
        
        if($validator->fails()){
            $res = ['code' => 400, 'msg' => '既に使用されているメールアドレスです。'];
            return response()->json($res);
        }
        $res = ['code' => 200, 'msg' => 'OK'];
        return response()->json($res);
    }
    public function post_token(Request $request) {
        $already_token = Provisional_registration_token::where('email', $request['email'])->first();
        if($already_token) {
            $already_token->delete();
        }
        $token = Str::random(64);
        $new_token = new Provisional_registration_token;
        $new_token->email = $request['email'];
        $new_token->password = $request['password'];
        $new_token->user_name = $request['user_name'];
        $new_token->token = $token;
        $new_token->save();
        $variables = [];
        $variables['url'] = config('app.front_url') . '/auth/main_registration/' . $token;
        Mail::to($request['email'])->send(new MainRegisterMail($variables,$token));
    // 	Mail::send('mails.main_register', $variables, function($message){
    // 	    $message->to('test@test.com', 'Test')->subject('仮登録が完了しました。');
    // 	});
        $res = ['code' => 200, 'msg' => 'OK'];
        return response()->json($res);
    }
}
