<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\CategoryDetail;
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
        $occupation_id = Category::select('id')->where('name', $datas['category1Name'])->first();
        $occupation_detail_id = CategoryDetail::select('id')->where('name', $datas['category2Name'])->first();
        $datas['occupation_id'] = $occupation_id['id'];
        $datas['occupation_detail_id'] = $occupation_detail_id['id'];
        \Log::info($datas);
        $edit_user_recode->fill($datas);
        $msg = [];
        $msg['msg'] = '変更がありません。';
        $msg['status'] = false;
        //変更の有無確認
        if($edit_user_recode->isDirty()) {
            $edit_user_recode->save();
            $msg['data'] = $edit_user_recode;
            $msg['msg'] = '更新しました。';
            $msg['status'] = true;
        }
        return response()->json([
            'data' => $msg,
            'category_detail_id' => $edit_user_recode['occupation_detail_id']
        ]);
    }
}
