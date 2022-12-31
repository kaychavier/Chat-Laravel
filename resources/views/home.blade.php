@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        @forelse ($users as $user)
                            <div class="col-10">
                                <p>{{$user->name}}</p>
                                <p>Última mensagem: {{$user->lastMessage()->content ?? 'Sem mensagens'}}</p>
                            </div>

                            <div class="col-2">
                                <img src="{{$user->img}}" class="img-fluid">
                                <a href="{{route('chat', $user)}}" class="btn btn-primary d-block my-2">
                                    <i class="bi bi-chat"></i>
                                </a>
                            </div>
                        @empty
                            <p class="text-danger">Nenhum usuário disponível</p>
                        @endforelse

                        {{ $users->links('vendor.pagination.bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
