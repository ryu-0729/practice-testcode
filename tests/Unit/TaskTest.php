<?php

namespace Tests\Unit;

// Taskモデルをインポート
use App\Task;
// use PHPUnit\Framework\TestCase;
// DatabaseTransactionsを使うためのインポート
use Illuminate\Foundation\Testing\DatabaseTransactions;
// 追加の行
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    // DatabaseTransactionsを使うため記述
    // use DatabaseTransactions;

    use RefreshDatabase;

    // データが存在しない場合の処理
    public function testGetTaskShowNotExists()
    {
        $tasks = Task::find(0);
        $this->assertNull($tasks);
    }

    // Task更新のテスト
    public function testUpdateTask()
    {
        $task = Task::create([
            'title' => 'test',
            'executed' => false,
        ]);

        $this->assertEquals('test', $task->title);
        $this->assertFalse($task->executed);

        $task->fill(['title' => 'テスト']);
        $task->save();

        $task2 = Task::find($task->id);
        $this->assertEquals('テスト', $task2->title);
    }
}
