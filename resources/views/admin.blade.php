@extends('layouts.app')
@section('title')
    Админка
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Админка') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if(Auth::user()->status_id == 1)
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
                                    <th scope="row" class="text-success"><a href=" {{ route('change.status', ['id' => $user->id]) }}" class="text-success">Сделать админом</a></th>
                                @endif

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
