<?php

namespace App\Http\Controllers;

// Taskモデルをインポート
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // indexアクションの追加
    public function index()
    {
        // Taskの全データの取得
        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    // showアクションの追加
    public function show(int $id)
    {
        // Taskそれぞれのデータの取得
        $task = Task::find($id);
        if ($task === null) {
            abort(404);
        }

        return view('tasks.show', ['task' => $task]);
    }

    // updateアクションの追加
    // バリデーションの追加
    public function update(int $id, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:512',
        ]);

        $task = Task::find($id);
        if ($task === null) {
            abort(404);
        }

        $fillData = [];
        if (isset($request->title)) {
            $fillData['title'] = $request->title;
        }
        if (isset($request->executed)) {
            $fillData['executed'] = $request->executed;
        }

        if (count($fillData) > 0) {
            $task->fill($fillData);
            $task->save();
        }

        return redirect('/tasks');
    }

    // newアクションの追加
    public function new()
    {
        return view('tasks.new');
    }

    // createアクションの追加
    // バリデーションの追加も行う
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:512',
        ]);

        Task::create(['title' => $request->title, 'executed' => false]);

        return redirect('/tasks');
    }

    // deleteアクションの追加
    public function delete(int $id)
    {
        Task::destroy($id);

        return redirect('/tasks');
    }
}
