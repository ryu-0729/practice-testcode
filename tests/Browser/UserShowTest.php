<?php

namespace Tests\Browser;

// Userモデルをインポート
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserShowTest extends DuskTestCase
{
    // 既存のデータベースに依存しないテストの作成
    use DatabaseMigrations;

    private $user;

    protected function setUp() :void
    {
        parent::setUp();
        $this->user = User::create([
            'name' => 'テストユーザー',
            'email' => 'sample@gmail.com',
            'password' => 'baseball',
        ]);
    }

    /**
     * User Show Test
     *
     * @return void
     */
    public function testShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/users/' . $this->user->id)
                ->assertSee('テストユーザー')
                ->assertSee('sample@gmail.com')
                ->screenshot('user_show');
        });
    }
}
