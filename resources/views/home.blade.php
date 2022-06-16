@extends('layouts.app')

@section('content')

<div>
    @auth
    <h2>Đã đăng nhập</h2>
    @endauth

    @guest
    chưa đăng nhập
    @endguest
</div>

@endsection