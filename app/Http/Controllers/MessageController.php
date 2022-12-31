<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $messages = $user->messages()->get();
        return $messages->reduce(function($str, $message){
            $isIssuer = $message->issuer_id == auth()->id();
            return $str.='
                <div class="row g-2 mb-2 '.($isIssuer ? 'justify-content-end':'').'">
                    <div class="col-1">
                        <img src="'.$message->issuer->img.'" class="img-fluid" height="30" />
                    </div>

                    <div class="col-6 col-md-4 bg-'.($isIssuer ? 'success' : 'primary').' text-white p-2 rounded-3">
                        '.$message->content.'
                    </div>
                </div>
            ';
        },'');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request, User $user)
    {
        Message::create($request->validated()+[
            'issuer_id' => auth()->id(),
            'reciever_id' => $user->id
        ]);
    }
}
