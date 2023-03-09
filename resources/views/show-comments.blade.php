@extends('layouts.app')
@section('title')
    Комментарии
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ $theme->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($comments as $comment)
                            <ul class="list-group list-group-flush">
                                <small class="text-end">{{ $comment->created_at }}</small>
                                <small class="text-end">{{ $comment->user->name }}</small>
                                <li class="list-group-item">{{ $comment->text }}</li>
                                <li class="list-group-item"></li>
                            </ul>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(Auth::check())
                    <form action="{{ route('add.comment', ['id' => $theme->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                        </div>
                        <div class="mb-3">
                            <textarea name="text" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Оставить комментарий</button>
                    </form>
                @else
                    <div class="mb-3">

                    </div>
                    <p>Чтобы оставить комментарий нужно <a href="{{ route('login') }}">Войти</a> или <a href="{{ route('register') }}">Зарегистрироваться</a></p>
                @endif
            </div>
        </div>
    </div>

@endsection
