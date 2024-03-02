<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CurrentPasswordRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // ユーザーがログインしているかを確認
        if (Auth::check()) {
            // ユーザーの現在のパスワードを取得
            $currentPassword = Auth::user()->password;
            // 入力されたパスワードが現在のパスワードと一致するかどうかを確認
            return Hash::check($value, $currentPassword);
        }

         return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'パスワードが正しくありません。';
    }
}
