@extends('layouts.app')
@section('title')
    Темы
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Темы') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @foreach($themes as $theme)
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $theme->name }}</h5>
                                    <small>{{ $theme->created_at }}</small>
                                </div>
                                <p class="mb-1">{{ $theme->description }}</p>
                                <small>Автор: {{ $theme->user->name }}</small>
                            </a>
                        </div>
                        @endforeach
                </div>
            </div>
            {{ $themes->links() }}
        </div>
    </div>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(Auth::check())
                    <form action="{{ route('add.theme', ['id' => $post]) }}" method="POST">
                        @csrf
                        <div class="mb-3">

                        </div>
                        <button type="submit" class="btn btn-primary">Добавить тему</button>
                    </form>
                @else
                    <div class="mb-3">

                    </div>
                    <p>Чтобы создать тему нужно <a href="{{ route('login') }}">Войти</a> или <a href="{{ route('register') }}">Зарегистрироваться</a></p>
                @endif
            </div>
        </div>
    </div>

@endsection
