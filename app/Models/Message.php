<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'reciever_id',
        'issuer_id'
    ];

    public function issuer(){
        return $this->belongsTo(User::class, 'issuer_id');
    }
}
