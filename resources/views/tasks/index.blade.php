@extends('layouts.app')
@section('content')
  <div class="container">
    <h2>Tasks List</h2>
    <div class="col-md-2">
      {{ link_to_action(
        'TaskController@new',
        '新規追加',
        [],
        ['class' => 'btn btn-primary btn-block']
      ) }}
    </div>
    <ul>
      @foreach ($tasks as $task)
      <li>
        <a href="/sample-test/public/tasks/{{ $task->id }}">{{ $task->title }}</a>
        <input type="checkbox" name="checkbox{{ $task->id }}" {!! $task->executed ? 'checked="checked"' : '' !!}>
      </li>
      @endforeach
    </ul>
  </div>
@endsection