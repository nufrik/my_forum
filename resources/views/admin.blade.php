@extends('layouts.app')
@section('title')
    Админка
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(Auth::user()->status_id == 1)
            <div class="card">
                <div class="card-header text-center">{{ __('Юзеры') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Имя юзера</th>
                                <th scope="col">Статус юзера</th>
                                <th scope="col">Изменить статус</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                            <tr>
                                <th scope="row"><a href="{{ route('user.profile', ['id' => $user->id]) }}"> {{ $user->name }}</a></th>
                                @if($user->status_id == 1)
                                    <th scope="row" class="text-success"> {{ $user->status->name }}</th>
                                @else
                                    <th scope="row"> {{ $user->status->name }}</th>
                                @endif
                                @if($user->status_id == 1)
                                <th scope="row"><a href="{{ route('change.status', ['id' => $user->id]) }}" class="text-danger">Сделать юзером</a></th>
                                @else
                                    <th scope="row"><a href=" {{ route('change.status', ['id' => $user->id]) }}" class="text-success">Сделать админом</a></th>
                                @endif
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Посты') }}</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Название поста</th>
                                <th scope="col">Автор поста</th>
                                <th scope="col">Изменить пост</th>
                                <th scope="col">Удалить пост</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->name }}</th>
                                    <th scope="row"> {{ $post->user->name }}</th>
                                    <th scope="row"><a href="{{ route('admin.update.post', ['id' => $post->id]) }}">Изменить пост</a></th>
                                    <th scope="row"><a href=" {{ route('delete.post', ['id' => $post->id]) }}" class="text-danger">Удалить пост</a></th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="mb-3">
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Темы') }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Название темы</th>
                            <th scope="col">Автор темы</th>
                            <th scope="col">Изменить тему</th>
                            <th scope="col">Удалить тему</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($themes as $theme)
                            <tr>
                                <th scope="row">{{ $theme->name }}</th>
                                <th scope="row"> {{ $theme->user->name }}</th>
                                <th scope="row"><a href="{{ route('update.theme', ['id' => $theme->id]) }}">Изменить тему</a></th>
                                <th scope="row"><a href=" {{ route('delete.theme', ['id' => $theme->id]) }}" class="text-danger">Удалить тему</a></th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Сообщения') }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Автор</th>
                            <th scope="col">Текст сообщения</th>
                            <th scope="col">Редактировать</th>
                            <th scope="col">Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <th scope="row">{{ $comment->user->name }}</th>
                                <th scope="row">{{ $comment->text }} </th>
                                <th scope="row"><a href="{{ route('update.comment', ['id' => $comment->id]) }}">Редактировать</a></th>
                                <th scope="row"><a href=" {{ route('delete.comment', ['id' => $comment->id]) }}" class="text-danger">Удалить</a></th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <h4 class="text-center">Для отображения страницы, нужно иметь статус "админ"</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
