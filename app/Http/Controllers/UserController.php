<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Userをインポート
use App\User;

class UserController extends Controller
{
    // indexアクションの追加
    public function index()
    {
        // Userの全データを取得
        $users = User::all();
        // $data = [
        //    'records' => User::all()
        // ];
        return view('users.index', ['users' => $users]);
    }

    // showアクションの追加
    public function show($id)
    {
        return view('users.show', [
            'user' => User::findOrFail($id)
        ]);
    }

    // editアクションの追加
    public function edit($id)
    {
        return view('users.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    // updateアクションの追加
    // バリデーションの追加
    public function update(Request $req, $id)
    {
        $validatedData = $req->validate([
            'name' => 'required|max:255',
        ]);

        // 目的のデータの取得
        $user = User::find($id);
        // 入力値でモデルを更新&保存
        $user->fill($req->except('_token', '_method'))->save();
        return redirect('/users');
    }
}
