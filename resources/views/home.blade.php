@extends('layouts.app')

@section('content')

<div>
    <!-- @auth
    <h2>Đã đăng nhập</h2>
    @endauth

    @guest
    chưa đăng nhập
    @endguest -->

    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
    @if(session()->get('failed'))
    <div class="alert alert-danger">
        {{ session()->get('failed') }}
    </div><br />
    @endif
</div>

@endsection