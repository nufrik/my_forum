@extends('layouts.app')
@section('title')
    Мои сообщения
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Мои сообщения') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Пост</th>
                                <th scope="col">Тема</th>
                                <th scope="col">Комментарий</th>
                                <th scope="col">Редактировать комментарий</th>
                                <th scope="col">Удалить комментарий</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $comment)
                            <tr>
                                <th scope="row">{{ $comment->theme->post->name }}</th>
                                <th scope="row">{{ $comment->theme->name }}</th>
                                <th scope="row">{{ $comment->text }}</th>
                                <th scope="row"><a href="{{ route('update.comment', ['id' => $comment->id]) }}">Редактировать</a></th>
                                <th scope="row"><a href="{{ route('delete.comment', ['id' => $comment->id]) }}" class="text-danger">Удалить</a></th>
                            </tr>
                                @endforeach

                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
