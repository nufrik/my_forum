@extends('layouts.app')
@section('title')
    Редактирование комментария
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Редактирование комментария') }}</div>

                <div class="card-body">
                    @if(Auth::check())
                    <form action="" method="POST">
                        @csrf
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label text-md-end">{{ __('Пост') }}</label>

                            <div class="col-md-6">
                                <input type="text"  class="form-control" value="{{ $comment->theme->post->name }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label text-md-end">{{ __('Название темы') }}</label>

                            <div class="col-md-6">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" value="{{ $comment->theme->name }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label text-md-end">{{ __('Комментарий') }}</label>

                            <div class="col-md-6">
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <textarea name="text" class="form-control" autofocus>{{ $comment->text }}</textarea>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Редактировать</button>
                                    @else
                                        <div class="mb-3">
                                        </div>
                                        <p>Чтобы создать пост нужно <a href="{{ route('login') }}">Войти</a> или <a href="{{ route('register') }}">Зарегистрироваться</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
