@extends('layouts.app')
@section('content')
  <div class="container">
    <h2>New Task</h2>
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
        {!! Form::open(['action' => ['TaskController@create'], 'method' => 'post']) !!}
        <table class="table table-hover">
          <thead>
            <tr>
              <td>タイトル</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ Form::text('title', '', ['id' => 'title', 'class' => 'form-control']) }}</td>
            </tr>
          </tbody>
        </table>
        {{ Form::submit('登録', ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection