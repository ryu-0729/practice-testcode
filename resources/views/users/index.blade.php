@extends('layouts.app')
@section('content')
  <table class="table">
    <tr>
      <th>No.</th>
      <th>名前</th>
      <th>メールアドレス</th>
      <th>アクション</th>
    </tr>
    @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>
          <a href="/sample-test/public/users/{{ $user->id }}">{{ $user->name }}</a>
        </td>
        <td>{{ $user->email }}</td>
        <td>
          <a href="/sample-test/public/users/{{ $user->id }}">詳細</a> |
          <a href="/sample-test/public/users/{{ $user->id }}/edit">編集</a>
        </td>
      </tr>
    @endforeach
  </table>
@endsection