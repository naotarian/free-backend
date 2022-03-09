<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserInformationController extends Controller
{
    //ユーザー情報更新用
    public function edit_user_information(Request $request) {
        $datas = $request->all();
        $user_id = $datas['id'];
        $messages = [
            'user_name.unique' => 'ユーザー名は既に使用されています。',
        ];
        $validator = Validator::make($datas,[
            'user_name' => "required|unique:users,user_name,$user_id,id,deleted_at,NULL",
        ],$messages);
        //すでに使われているユーザー名だったらreturn
        if($validator->fails()){
            $res = ['code' => 400, 'msg' => $messages];
            return response()->json($res);
        }
        $edit_user_recode = User::find($datas['id']);
        $edit_user_recode->fill($datas);
        $msg = [];
        $msg['msg'] = '変更がありません。';
        $msg['status'] = false;
        //変更の有無確認
        if($edit_user_recode->isDirty()) {
            $edit_user_recode->save();
            $msg['msg'] = '更新しました。';
            $msg['status'] = true;
        }
        return response()->json([
            'data' => $msg,
        ]);
    }
}
