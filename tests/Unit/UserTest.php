<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
// Userモデルをインポート
use App\User;
// DatabaseTransactionsを使うためのインポート
use Illuminate\Foundation\Testing\DatabaseTransactions;
// 追加の行
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    // User更新のテスト
    public function testUpdateUser()
    {
        $user = User::create([
            'name' => 'テストユーザー',
            'email' => 'sample@gmail.com',
            'password' => 'baseball',
        ]);

        $this->assertEquals('テストユーザー', $user->name);
        
        $user->fill(['name' => 'テストくん']);
        $user->save();

        $user2 = User::find($user->id);
        $this->assertEquals('テストくん', $user2->name);
    }
}
