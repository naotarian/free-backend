<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\business_users;
use App\Models\general_users;
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
    //仮登録トークン保存処理
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
        $account_type = $token_table_array_datas['account_type'];
        //一般かビジネスかの分岐
        $new_user = $account_type == 'business' ? new business_users : new general_users;
        $new_user->email = $token_table_array_datas['email'];
        $new_user->password = $token_table_array_datas['password'];
        $new_user->user_name = $token_table_array_datas['user_name'];
        $new_user->save();
        $token_table_datas->delete();
        $res = ['code' => 200, 'msg' => 'OK'];
        return response()->json($res);
    }
}
