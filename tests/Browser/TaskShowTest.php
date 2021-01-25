<?php

namespace Tests\Browser;

// Taskモデルをインポート
use App\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskShowTest extends DuskTestCase
{
    // 既存のデータベースに依存しないテストの作成
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
     * Task Show Test
     *
     * @return void
     */
    public function testShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/tasks/' . $this->task->id)
                ->assertInputValue('#title', 'テストタスク')
                ->screenshot('task_show');
        });
    }

    /**
     * Task Put Test
     *
     * @return void
     */
    public function testPut()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/tasks/' . $this->task->id)
                ->assertInputValue('#title', 'テストタスク')
                ->type('#title', 'test task')
                ->screenshot('task_post_typed')
                ->press('更新')
                ->pause(1000)
                ->assertPathIs('/sample-test/public/tasks/' . $this->task->id)
                ->assertInputValue('#title', 'test task')
                ->screenshot('task_put_pressed');
        });
    }

    /**
     * Update Task Page Test (Empry Title).
     *
     * @return void
     */
    public function testUpdateEmptyTitle_failed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/tasks/' . $this->task->id)
            ->assertInputValue('#title', 'テストタスク')
            ->type('#title', '')
            ->screenshot('empty_task_put_typed')
            ->press('更新')
            ->pause(1000)
            ->assertPathIs('/sample-test/public/tasks/' . $this->task->id)
            ->assertSee('The title field is required.')
            ->screenshot('task_show_empty_title');
        });
    }
}
