<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __invoke(User $user)
    {
        return view('chat', compact('user'));
    }
}
