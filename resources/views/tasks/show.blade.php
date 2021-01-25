@extends('layouts.app')
@section('content')
  <div class="container">
    <h2>Tasks Show</h2>
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        {!! Form::open(['action' => ['TaskController@update', $task->id], 'method' => 'put']) !!}
        <table class="table table-hover">
          <thead>
            <tr>
            <td>タイトル</td>
            <td>実行済み</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ Form::text('title', $task->title, ['id' => 'title', 'class' => 'form-control']) }}</td>
              <td>{{ Form::checkbox('executed', 'on', $task->executed) }}</td>
            </tr>
          </tbody>
        </table>
        {{ Form::submit('更新', ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
      </div>
    </div>
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        {!! Form::open(['action' => ['TaskController@delete', $task->id], 'method' => 'delete']) !!}
        {{ Form::submit('削除', ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection