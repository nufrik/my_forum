@extends('layouts.app')
@section('title')
    Профиль юзера
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Профиль юзера') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Имя</th>
                                <th scope="col">Емейл</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Дата регистрации</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{ $user->name }}</th>
                                <th scope="row">{{ $user->email }}</th>
                                <th scope="row"> {{ $user->status->name }} </th>
                                <th scope="row">{{ $user->created_at }}</th>
                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
