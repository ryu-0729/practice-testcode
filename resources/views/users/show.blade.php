@extends('layouts.app')
@section('content')
<table class="table">
  <tr>
    <th>No.</th>
    <th>名前</th>
    <th>メールアドレス</th>
  </tr>
  <tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
  </tr>
</table>
@endsection