@extends('layouts.app')
@section('title')
    Мои посты
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Мои посты') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Краткое описание</th>
                                <th scope="col">Редактировать</th>
                                <th scope="col">Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->name }}</th>
                                <th scope="row">{{ $post->description }}</th>
                                <th scope="row"><a href="{{ route('update.post', ['id' => $post->id]) }}">Редактировать</a></th>
                                <th scope="row"><a href="{{ route('delete.post', ['id' => $post->id]) }}" class="text-danger">Удалить</a></th>
                            </tr>
                                @endforeach

                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(Auth::check())
                    <form action="{{ route('add.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">

                        </div>
                        <button type="submit" class="btn btn-primary">Добавить пост</button>
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
