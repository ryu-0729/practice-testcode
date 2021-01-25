@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form method="POST" action="/sample-test/public/users/{{ $user->id }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label id="name">名前:</label><br>
          <input id="name" name="name" type="text"
            class="form-control" value="{{ old('name', $user->name) }}">
        </div>
        <div class="form-group">
          <label id="email">メールアドレス:</label><br>
          <input id="email" name="email" type="text"
          class="form-control" value="{{ old('email', $user->email) }}">
        </div>
        <div class="form-group">
          <input type="submit" value="編集" class="btn btn-embossed btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection