<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WeightTarget;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // STEP1表示
    public function showStep1()
    {
        return view('auth.register-step1');
    }

    // STEP1処理 → ユーザー作成 → ログイン → STEP2へ
    public function postStep1(RegisterStep1Request $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('register.step2');
    }

    // STEP2表示
    public function showStep2()
    {
        return view('auth.register-step2');
    }

    // STEP2処理 → 目標体重保存 →管理ページへ
    public function postStep2(RegisterStep2Request $request)
    {
        $user = Auth::user();

        WeightTarget::create([
            'user_id'        => $user->id,
            'target_weight'  => $request->target_weight,
        ]);

        return redirect()->route('weight_logs.index')->with('status', '登録が完了しました！');
    }
}