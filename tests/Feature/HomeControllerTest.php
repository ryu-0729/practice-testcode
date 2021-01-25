<?php

namespace Tests\Feature;

// Userをインポート
use App\User;
// 追加
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use DatabaseTransactions; // 追加

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        // ファクトリでユーザーデータを作成
        $user = factory(User::class)->create();

        // ホーム画面のパス
        $response = $this
            //->actingAs(User::find(1)) // Userからid1のユーザーを取得
            ->actingAs($user) // ファクトリで作ったユーザーデータでログイン状態を作る
            ->get(route('home'));

        $response->assertStatus(200)
            ->assertViewIs('home') // (ここでのhomeはホーム画面で使われているビュー名)
            ->assertSee('You are logged in!'); // ホーム画面で表示されているメッセージ
    }
}
