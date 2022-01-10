<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token'
    ];

    public function getRouteKeyName(): String
    {
        return 'token';
    }

    public static function generateTokenFor(User $user)
    {
        return static::create([
            'user_id' => $user->id,
            'token' => Str::random(50)
        ]);
    }

    public function sendTokenToUserEmail()
    {
        $url = url('/auth/token' , $this->token);

        Mail::raw(
            "<a href='{$url}'>{$url}</a>",
            function ($message){
                $message->to($this->user->email)
                        ->subject("Sign into ......");
            }
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
