<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\Matter;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DynamicController extends Controller
{
    //Topページ情報取得
    public function index_get(Request $request) {
        $default_info = [];
        $categories = CategoryDetail::orderBy('category_id', 'asc')->get();
        $default_info['categories'] = $categories;
        return response()->json([
            'default_info' => $default_info,
            'status' => '200,'
        ]);
    }
    //案件一覧情報取得
    public function get_category(Request $request) {
        $matters_info = [];
        $matters_info['categories'] = Category::all();
        $matters_info['category_detail'] = CategoryDetail::all();
        return response()->json([
            'matters' => $matters_info
        ]);
    }
    //案件作成
    public function create_matters(Request $request) {
        $datas = $request->all();
        $today = Carbon::today();
        $publish_date = new Carbon($datas['yaer'] . '-' . $datas['month'] . '-' . $datas['day']);
        $datas['is_display'] = $publish_date > $today ? 0 : 1;
        $datas['publish_date'] = $publish_date->format('Y-m-d');
        foreach($datas['data'] as $key => $data) {
            $datas['sub_title_' . ($key + 1)] = $data['sub_title'];
            $datas['content_' . ($key + 1)] = $data['content'];
        }
        //バリデーション処理
        $new_ins = new Matter;
        $new_ins->fill($datas);
        $save = $new_ins->save();
        if($save) {
            $res = ['status' => 'OK'];
        } else {
            $res = ['status' => 'NG'];
        }
        return response()->json($res);
    }
    //案件初期データAPI
    public function default_matters(Request $request) {
        $category = $request['category'];
        $matters = Matter::where('occupation_detail_id', $category)->get();
        return response()->json($matters);
    }
    //カテゴリ絞り込み時
    public function get_matters(Request $request) {
        $res = ['status' => 'OK'];
        $matters = Matter::whereIn('occupation_detail_id',$request)->get();
        return response()->json($matters);
    }
}
