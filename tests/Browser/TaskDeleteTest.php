<?php

namespace Tests\Browser;

// Taskモデルをインポート
use App\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskDeleteTest extends DuskTestCase
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
     * Delete Task Test.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/tasks/' . $this->task->id)
                ->press('削除')
                ->pause(1000)
                ->assertPathIs('/sample-test/public/tasks');
        });
    }
}
