@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Посты') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach($posts as $key => $post)
                                    @if($key == 0)
                                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $key }}" class="active" aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
                                    @else
                                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $key }}" aria-label="Slide {{ $key + 1 }}"></button>
                                    @endif
                                @endforeach
                            </div>
                            <div class="carousel-inner">

                                @foreach($posts as $key => $post)
                                    @if($key == 0)
                                    <div class="carousel-item active" data-bs-interval="5000">
                                        <a href="{{ 'post/' . $post->id }}">
                                            <img src="{{ asset('/storage/' . $post->img) }}" width="450" height="450" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5 class="text-warning">{{ $post->name }}</h5>
                                            <p class="text-warning">{{ $post->description }}</p>
                                            <small class="text-warning"> Автор: {{ $post->user->name }}</small>
                                        </div>
                                        </a>
                                    </div>

                                    @else
                                        <div class="carousel-item" data-bs-interval="2000">
                                            <a href="{{ 'post/' . $post->id }}">
                                            <img src="{{ asset('/storage/' . $post->img) }}" width="450" height="450" class="d-block w-100" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 class="text-warning">{{ $post->name }}</h5>
                                                <p class="text-warning">{{ $post->description }}</p>
                                                <small class="text-warning"> Автор: {{ $post->user->name }}</small>
                                            </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Предыдущий</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Следующий</span>
                            </button>
                    </div>
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
                        <button type="submit" class="btn btn-primary">Создать пост</button>
                    </form>
                    @else
                    <div class="mb-3">

                    </div>
                <p>Чтобы создать пост нужно <a href="{{ route('login') }}">Войти</a> или <a href="{{ route('register') }}">Зарегистрироваться</a></p>
                @endif
            </div>
        </div>
    </div>

@endsection
