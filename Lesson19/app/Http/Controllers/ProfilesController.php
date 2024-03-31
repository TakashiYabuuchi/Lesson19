<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

// use宣言追加（バリデーションルール）
use Illuminate\Validation\Rule;



class ProfilesController extends Controller
{
    // userProfileメソッド（ログインユーザーのプロフィール画面表示）
    public function userProfile()
    {
        // ログインユーザーのID取得
        $user = \Auth::user()->id;
        // postsテーブルでユーザーIDが一致する投稿データを取得
        $user_post = DB::table('posts')
            ->where('user_id', $user)
            ->get();

        // ログインユーザーのフォロー数取得
        $number_following = DB::table('follows')
            ->where('following_user_id', $user)
            ->count();

        // ログインユーザーのフォロワー数取得
        $number_followed = DB::table('follows')
            ->where('followed_user_id', $user)
            ->count();

        return view('profiles.userProfile', ['user_posts' => $user_post, 'number_following' => $number_following, 'number_followed' => $number_followed]); // ビューファイルuserProfile.blade.php呼び出し
    }


    // updateProfileFormメソッド（ログインユーザーのプロフィール編集画面表示）
    public function updateProfileForm(Request $request)
    {
        $password_form=$request->input('passwordForm');
        return view ('profiles.updateProfileForm',['password_form'=>$password_form]);// ビューファイルupdateProfileForm.blade.php呼び出し
    }


    // updateProfileメソッド（ログインユーザーのプロフィール編集処理）
    public function updateProfile(Request $request)
    {
        $user = \Auth::user()->id; // ログインユーザーのID取得
        //入力内容を取得
        $up_name = $request->input('upName'); // 入力されたユーザー名取得
        $up_bio = $request->input('upBio'); // 入力された自己紹介文取得
        $up_image = $request->file('upIcon'); // アップロードされたファイル取得
        $up_password = $request->input('upPassword'); // 入力された現在のパスワード取得
        $new_password = $request->input('newPassword'); // 入力された新しいパスワード取得
        $delete_icon = $request->input('deleteIcon'); // アイコンを消去するチェックボックスの値取得

        // バリデーション
        $validated = $request->validate(
            [
                'upName' => [Rule::unique('users', 'name')->whereNot('id', $user), 'required', 'string', 'nospace', 'max:12'],
                'upBio' => 'nullable|max:100',
                'upIcon' => 'nullable|max:1024',
                'upPassword' => 'required|CurrentPassword',
                'newPassword' => 'confirmed|min:6|max:12|nospace',
            ],
            [ // エラーメッセージ
                'upName.string' => '名前はスペースのみでは登録できません。',
                'upName.nospace' => '名前はスペースのみでは登録できません。',
                'upName.max' => '登録可能な名前は12文字までです。',
                'upIcon' => 'アイコンには、1024 KB以下のファイルを指定してください。',
                'upBio.max' => '登録可能な自己紹介は100文字までです。'
            ]
        );
        //自己紹介文と2テーブルのユーザー名を更新
        // usersテーブル
        DB::table('users')
            ->where('id', $user)
            ->update([
                'name' => $up_name,
                'bio' => $up_bio,
            ]);
        // postsテーブル
        DB::table('posts')
            ->where('user_id', $user)
            ->update([
                'user_name' => $up_name,
            ]);

        // アイコン消去にチェックが入っている場合、アイコン画像をデフォルトに戻す
        if (isset($delete_icon)) {
            DB::table('users')
                ->where('id', $user)
                ->update([
                    'image_path' => 'default.png',
                    'image_name' => 'default.png',
                ]);
        }

        // ファイルがアップロードされている場合、アップロードされた画像をアイコンに設定
        if (isset($up_image)) {
            $image_name = $up_image->getClientOriginalName();
            $image_path = $request->file('upIcon')->storeAs('', $user.'.png', 'public'); // 入力されたファイルを取得し、ユーザーidをつけてpngファイルとしてpublicに格納
            DB::table('users')
                ->where('id', $user)
                ->update([
                    'image_path' => $image_path,
                    'image_name' => $image_name,
                ]);
        }

        // 新規パスワードが入力されている場合、パスワードを更新
        if (isset($new_password)) {
            DB::table('users')
                ->where('id', $user)
                ->update([
                    'password' => bcrypt($new_password)
                ]);
        }

        return redirect('/userProfile'); // /userProfileへ遷移
    }


    // userSearchメソッド（ユーザー検索画面）
    public function userSearch(Request $request)
    {
        // ユーザー検索画面を開いた場合
        $user = \Auth::user()->id; // ログインユーザーのID取得
        $keyword = $request->input('userSearch'); // 検索フォームに入力されたデータ取得
        $user_list = DB::table('users')->get(); // すべてのユーザーのリスト取得
        $my_follow = DB::table('follows')->where('following_user_id', $user)->get(); // ユーザーがフォローしているユーザーのリスト取得

        if (!empty($keyword) && !mb_ereg_match("^(\s|　)+$", $keyword)) { // 検索フォームに入力されている場合
            $user_list = DB::table('users')
                ->where('name', 'LIKE', "%{$keyword}%")->get(); // 入力されたワードに完全もしくは部分一致したデータを検索
            return view('profiles.userSearch', ['user_lists' => $user_list, 'my_follows' => $my_follow, 'keyword' => $keyword]); // ビューファイルuserSearch.blade.php呼び出し
        } else {
            // 検索フォームに入力がない場合
            return view('profiles.userSearch', ['user_lists' => $user_list, 'keyword' => $keyword, 'my_follows' => $my_follow]); // ビューファイルuserSearch.blade.php呼び出し
        }
    }


    // followingListメソッド（フォローリスト表示）
    public function followingList()
    {
        // ログインユーザーID取得
        $user = \Auth::user()->id;
        // usersテーブルとfollowsテーブルを結合し、ログインユーザーIDと一致するフォローIDを取得
        $following_list = DB::table('users')
            ->join('follows', 'users.id', '=', 'followed_user_id')->where('following_user_id', $user)->get();
        return view('profiles.followingList', ['following_lists' => $following_list]); // ビューファイルfollowingList.blade.php呼び出し
    }


    // followedListメソッド（フォロワーリスト画面表示）
    public function followedList()
    {
        // ログインユーザーID取得
        $user = \Auth::user()->id;
        // usersテーブルとfollowsテーブルを結合し、ログインユーザーIDと一致するフォロワーIDを取得
        $followed_list = DB::table('users')
            ->join('follows', 'users.id', '=', 'following_user_id')->where('followed_user_id', $user)->get();
        // ログインユーザーがフォローしているデータを取得
        $my_follow = DB::table('follows')->where('following_user_id', $user)->get();
        return view('profiles.followedList', ['followed_lists' => $followed_list, 'my_follows' => $my_follow]); // ビューファイルfollowedList.blade.php呼び出し
    }


    // addFollowメソッド（フォロー追加処理）
    public function addFollow(Request $request)
    {
        $user = \Auth::user()->id; // ログインしているユーザーのIDを取得
        $user_list = DB::table('users')->get();
        $my_follow = DB::table('follows')->where('following_user_id', $user)->get(); // ログインユーザーがフォローしているユーザーIDを取得
        $add_follow = $request->input('addFollow'); // クリックしたフォローボタンのユーザーID取得

        // followsテーブルに追加
        DB::table('follows')
            ->insert([
                'followed_user_id' => $add_follow,
                'following_user_id' => $user,
            ]);
        return back(); // 直前のページに戻る
    }


    // removeFollowメソッド（フォロー削除処理）
    public function removeFollow(Request $request)
    {
        $user = \Auth::user()->id; // ログインしているユーザーのIDを取得
        $user_list = DB::table('users')->get();
        $my_follow = DB::table('follows')->where('following_user_id', $user)->get(); // ログインユーザーがフォローしているユーザーIDを取得
        $remove_follow = $request->input('removeFollow'); // クリックしたフォロー解除ボタンのユーザーID取得

        // followsテーブルから削除
        DB::table('follows')
            ->where('following_user_id', $user)->where('followed_user_id', $remove_follow)
            ->delete();
        return back(); // 直前のページに戻る
    }


    // memberProfileメソッド（ユーザーリストで選択したユーザーのプロフィール画面表示）
    public function memberProfile($id)
    {
        // 選択したユーザーのIDが一致するデータを取得
        $member_profile = DB::table('users')
            ->where('id', $id)->get();
        $member_post = DB::table('posts')
            ->where('user_id', $id)
            ->get();

        // 選択したユーザーのフォロー数取得
        $number_following = DB::table('follows')
            ->where('following_user_id', $id)
            ->count();

        // 選択したユーザーのフォロワー数取得
        $number_followed = DB::table('follows')
            ->where('followed_user_id', $id)
            ->count();
        return view('profiles.memberProfile', ['member_profiles' => $member_profile, 'member_posts' => $member_post, 'number_following' => $number_following, 'number_followed' => $number_followed]); // ビューファイルmemberProfile.blade.php呼び出し
    }

    // 認証機能追加
    public function __construct()
    {
    $this->middleware('auth');
    }

}
