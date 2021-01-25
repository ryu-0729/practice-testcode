<?php

namespace Tests\Browser;

// Userモデルをインポート
use App\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserEditTest extends DuskTestCase
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
     * User Patch Test
     *
     * @return void
     */
    // User更新のテスト
    public function testPatch()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/users/' . $this->user->id . '/edit')
                ->assertInputValue('.form-control#name', 'テストユーザー')
                ->type('.form-control#name', 'テストくん')
                ->screenshot('user_put_typed')
                ->press('編集')
                ->pause(1000)
                ->assertPathIs('/sample-test/public/users')
                ->assertSee('テストくん')
                ->screenshot('user_put_pressed');
        });
    }

    /**
     * Update User Page Test (Empry Title).
     *
     * @return void
     */
    public function testUpdateEmptyName_failed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/users/' . $this->user->id . '/edit')
                ->assertInputValue('.form-control#name', 'テストユーザー')
                ->type('.form-control#name', '')
                ->screenshot('empty_user_put_typed')
                ->press('編集')
                ->pause(1000)
                ->assertPathIs('/sample-test/public/users/' . $this->user->id . '/edit')
                ->assertSee('The name field is required.')
                ->screenshot('user_edit_empty_name');
        });
    }
}
