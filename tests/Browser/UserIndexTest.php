<?php

namespace Tests\Browser;

// Userモデルをインポート
use App\User;
// 追加
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserIndexTest extends DuskTestCase
{
    // 既存のデータに依存しないテスト
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
     * Get All User Path Test
     *
     * @return void
     */
    public function testGetAllUserPath()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/users')
                ->assertSee('テストユーザー')
                ->assertSee('sample@gmail.com')
                ->screenshot('users_index');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testIndexToShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/users')
                ->assertSeeLink('テストユーザー')
                ->clickLink('テストユーザー')
                ->waitForLocation('/sample-test/public/users/' . $this->user->id, 3)
                ->assertPathIs('/sample-test/public/users/' . $this->user->id)
                ->assertSee('テストユーザー');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testIndexToEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/users')
                ->assertSeeLink('編集')
                ->clickLink('編集')
                ->waitForLocation('/sample-test/public/users/' . $this->user->id . '/edit', 3)
                ->assertPathIs('/sample-test/public/users/' . $this->user->id . '/edit');
        });
    }
}
