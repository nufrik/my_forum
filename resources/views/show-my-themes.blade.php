@extends('layouts.app')
@section('title')
    Мои темы
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Мои темы') }}</div>

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
                                <th scope="col">Название темы</th>
                                <th scope="col">Краткое описание</th>
                                <th scope="col">Редактировать тему</th>
                                <th scope="col">Удалить тему</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($themes as $theme)
                            <tr>
                                <th scope="row">{{ $theme->post->name }}</th>
                                <th scope="row">{{ $theme->name }}</th>
                                <th scope="row">{{ $theme->description }}</th>
                                <th scope="row"><a href="{{ route('update.theme', ['id' => $theme->id]) }}">Редактировать</a></th>
                                <th scope="row"><a href="{{ route('delete.theme', ['id' => $theme->id]) }}" class="text-danger">Удалить</a></th>
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
