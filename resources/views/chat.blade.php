@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-3">
                            <img src="{{$user->img}}" alt="" width="50" height="50">
                        </div>
                        <div class="col-3">
                            {{$user->name}}
                        </div>
                        <div class="col-3 p-0 text-end">
                            <a href="{{route('home')}}" class="btn btn-sm btn-primary mt-1">
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body overflow-y-auto" style="height:400px" id="message-list"></div>
                <div class="card-footer py-0 px-3">
                    <form action="{{route('message.store', $user)}}" method="post" id="message-form">
                        @csrf
                        <div class="row">
                            <div class="col-11 p-0">
                                <input autofocus required name="content" id="content" placeholder="Digite sua mensagem..." class="form-control">
                            </div>
                            <div class="col-1 p-0">
                                <button class="btn btn-primary d-block w-100">
                                    <i class="bi bi-send-fill"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const messageForm = document.getElementById('message-form')
    const messageList = document.getElementById('message-list')
    let scroll = true
    const handleSubmit = async e => {
        e.preventDefault()
        await fetch(messageForm.action, {
            headers:{
                'Csrf-Token': '{{csrf_token()}}'
            },
            method: 'post',
            body: new FormData(messageForm)
        })
        document.getElementById('content').value = ""
        scroll = true
    }

    const loadChat = async () => {
        messageList.innerHTML = await (await fetch("{{route('message.index', $user)}}")).text()
        if(scroll){
            messageList.scrollTop = messageList.scrollHeight
            scroll = false
        }
    }

    setInterval(loadChat, 500);
    messageForm.addEventListener('submit', handleSubmit)
</script>
@endsection
