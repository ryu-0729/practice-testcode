<?php

namespace Tests\Browser;
// Taskモデルをインポート
use App\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskIndexTest extends DuskTestCase
{
    // 既存のデータに依存しないテスト
    use DatabaseMigrations;

    private $task;

    protected function setUp() :void
    {
        parent::setUp();
        $this->task = Task::create([
            'title' => 'テストタスク',
            'executed' => false,
        ]);
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/tasks')
                ->assertSee('テストタスク')
                ->screenshot('tasks_index');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    // ページ遷移のテストshow
    public function testIndexToShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/tasks')
                ->assertSeeLink('テストタスク')
                ->clickLink('テストタスク')
                ->waitForLocation('/sample-test/public/tasks/' . $this->task->id, 3)
                ->assertPathIs('/sample-test/public/tasks/' . $this->task->id)
                ->assertInputValue('#title', 'テストタスク');
        });
    }

    /**
     * Index To New Test.
     *
     * @return void
     */
    // ページ遷移のテストnew
    public function testIndexToNew()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/tasks')
                ->assertSeeLink('新規追加')
                ->clickLink('新規追加')
                ->waitForLocation('/sample-test/public/tasks/new')
                ->assertPathIs('/sample-test/public/tasks/new');
        });
    }
}
