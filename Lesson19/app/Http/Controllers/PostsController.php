<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    //indexメソッド（投稿一覧画面表示）
    public function index(Request $request)
    {
    $user=\Auth::user()->id;// ログインユーザーid取得
    $keyword=$request->input('postSearch');// 検索フォームに入力されたデータ取得
    $my_follow=DB::table('follows')->where('following_user_id',$user)->pluck('followed_user_id');// ログインユーザーがフォローしているユーザーIDを取得
    $list=DB::table('posts')->WhereIn('user_id',$my_follow)->orWhere('user_id',$user)->get();// フォローユーザーとログインユーザーの投稿を取得

    if(!empty($keyword) && !mb_ereg_match("^(\s|　)+$", $keyword)) {// 検索フォームに入力がある場合
    // 検索ワードが入っている自分の投稿もしくはフォローしているユーザーの投稿を検索
    $list=DB::table('posts')
    ->where('contents', 'LIKE', "%{$keyword}%")
    ->where(function($query)use($my_follow, $user){
        $query->WhereIN('user_id',$my_follow)
            ->orWhere('user_id',$user);
    })
    ->get();
    return view('posts.index', ['lists'=>$list,'keyword'=>$keyword]);// ビューファイルindex.blade.php呼び出し
    } else {
    return view('posts.index', ['lists'=>$list,'keyword'=>$keyword]);// ビューファイルビューファイルindex.blade.php呼び出し
    }
    }

    // createFormメソッド（新規投稿画面表示）
    public function createForm()
    {
    return view ('posts.createForm');// ビューファイルcreateForm.blade.php呼び出し
    }

    // createメソッド（新規投稿処理）
    public function create(Request $request)
    {
    $user_id=\Auth::user()->id;// ログインしているユーザーのユーザーIDを取得
    $user_name=\Auth::user()->name;// ログインしているユーザーのユーザー名を取得
    $post=$request->input('newPost');// 投稿フォームに入力されたデータ取得
    // バリデーション（空白のみでの投稿不可・文字数150字まで）
    $validated=$request->validate([
        'newPost'=>'nospace|string|max:150'
        ],
        [// エラーメッセージ
        'newPost.nospace'=>'空白のみでの投稿はできません。',
        'newPost.string'=>'空白のみでの投稿はできません。',
        'newPost.max'=>'投稿可能なメッセージは150文字までです。'
        ]);
    // postsテーブルにユーザー名と投稿内容、ユーザーidを登録
    DB::table('posts')->insert([
    'user_id'=>$user_id,
    'user_name'=>$user_name,
    'contents'=>$post
    ]);
    return redirect('/index');// /indexへ遷移
    }

    // updateFormメソッド（投稿編集画面表示）
    public function updateForm($id)
    {
    $user_check=DB::table('posts')
    ->where('id',$id)
    ->get();
    if($user_check->contains('user_id',\Auth::user()->id)){
    //更新したい投稿のIDを受け取り、投稿内容を取得
    $post=DB::table('posts')
    ->where('id',$id)
    ->first();
    return view('posts.updateForm',['post'=>$post]);// ビューファイルupdateForm.blade.php呼び出し
    }else{
    return redirect('/index');
    }}

    // updateメソッド（投稿編集処理）
    public function update(Request $request)
    {
    // 変更したい投稿のIDと更新内容を取得
    $id=$request->input('id');
    $up_post=$request->input('upPost');
    // バリデーション（空白のみでの投稿不可・文字数150字まで）
    $validated=$request->validate([
    'upPost'=>'nospace|string|max:150'
    ],
    [// エラーメッセージ
    'upPost.nospace'=>'空白のみでの投稿はできません。',
    'upPost.string'=>'空白のみでの投稿はできません。',
    'upPost.max'=>'投稿可能なメッセージは150文字までです。'
    ]);
    // postsテーブルの投稿内容を更新
    DB::table('posts')
    ->where('id',$id)
    ->update(
    ['contents'=>$up_post]
    );
    return redirect('/index');// /indexへ遷移
    }

    // deleteメソッド（投稿削除処理）
    public function delete(Request $request)
    {
    // 削除したい投稿のIDを受け取り、投稿内容を削除
    $id=$request->input('id');
    DB::table('posts')
    ->where('id',$id)
    ->delete();
    return redirect('/index');// /indexへ遷移
    }


    // 認証機能追加
    public function __construct()
    {
    $this->middleware('auth');
    }

    // registerSuccessメソッド（新規登録完了画面表示）
    public function registerSuccess()
    {
    return view ('auth.registerSuccess');// ビューファイルregisterSuccess.blade.php呼び出し
    }



}
