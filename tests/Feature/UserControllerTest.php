<?php

namespace Tests\Feature;

// Userをインポート
use App\User;
// 追加
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    // 追加
    use RefreshDatabase;

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
     * Get All User Path Test.
     *
     * @return void
     */
    public function testGetAllUserPath()
    {
        $response = $this->get('/users');

        $response->assertStatus(200)
            ->assertViewIs('users.index');
    }

    /**
     * Get User Show Path Test
     *
     * @return void
     */
    public function testGetShowUserPath()
    {
        $response = $this->get('/users/' . $this->user->id);

        $response->assertStatus(200)
            ->assertViewIs('users.show');
    }

    /**
     * Get User Show Path Not Exists Test
     *
     * @return void
     */
    public function testGetShowUserPathNotExists()
    {
        $response = $this->get('/users/0');

        $response->assertStatus(404);
    }

    /**
     * Get User Edit Path Test
     *
     * @return void
     */
    public function testGetEditUserPath()
    {
        $response = $this->get('/users/' . $this->user->id . '/edit');

        $response->assertStatus(200)
            ->assertViewIs('users.edit');
    }

    /**
     * Patch User Edit Path Test
     *
     * @return void
     */
    public function testPatchUserPath()
    {
        $data = [
            'name' => 'テストくん',
        ];
        $this->assertDatabasemissing('users', $data);

        $response = $this->patch('/users/' . $this->user->id, $data);

        $response->assertStatus(302)
            ->assertRedirect('/users');
        
        $this->assertDatabaseHas('users', $data);
    }

    /**
     * Patch User Edit Path Test 2
     *
     * @return void
     */
    public function testPatchUserPath2()
    {
        $data = [
            'name' => 'テストくん',
            'email' => 'baseball@gmail.com',
        ];
        $this->assertDatabasemissing('users', $data);

        $response = $this->patch('/users/' . $this->user->id, $data);

        $response->assertStatus(302)
            ->assertRedirect('/users');
        
        $this->assertDatabaseHas('users', $data);
    }

    /**
     * Patch User Path Test (Without Name)
     *
     * @return void
     */
    public function testPatchUserPathWithoutName_failed()
    {
        $data = [];
        $response = $this->from('/users/' . $this->user->id . '/edit')
            ->patch('/users/' . $this->user->id, $data);

        $response->assertSessionHasErrors(['name' => 'The name field is required.']);

        $response->assertStatus(302)
            ->assertRedirect('/users/' . $this->user->id . '/edit');
    }

    /**
     * Patch User Path Test (Empty name)
     *
     * @return void
     */
    public function testPatchEmptyName_failed()
    {
        $data = [
            'name' => ''
        ];
        $response = $this->from('/users/' . $this->user->id . '/edit')
            ->patch('/users/' . $this->user->id, $data);

        $response->assertSessionHasErrors(['name' => 'The name field is required.']);

        $response->assertStatus(302)
            ->assertRedirect('/users/' . $this->user->id . '/edit');
    }

    /**
     * Patch User Path Test (Max Length)
     *
     * @return void
     */
    public function testPatchPathNameMaxLength()
    {
        $data = [
            'name' => str_random(255)
        ];

        $this->assertDatabaseMissing('users', $data);

        $response = $this->patch('/users/' . $this->user->id, $data);

        $response->assertStatus(302)
            ->assertRedirect('/users');

        $this->assertDatabaseHas('users', $data);
    }

    /**
     * Patch User Path Test (Max Length + 1)
     *
     * @return void
     */
    public function testPatchUserNameMaxLengthPlus1_failed()
    {
        $data = [
            'name' => str_random(256)
        ];

        $response = $this->from('/users/' . $this->user->id . '/edit')
            ->patch('/users/' . $this->user->id, $data);

        $response->assertSessionHasErrors(['name' => 'The name may not be greater than 255 characters.']);

        $response->assertStatus(302)
            ->assertRedirect('/users/' . $this->user->id . '/edit');
    }
}
