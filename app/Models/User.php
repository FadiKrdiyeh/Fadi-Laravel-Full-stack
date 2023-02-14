<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token',];
    public $timestamps = true;

    protected $casts = ['email_verified_at' => 'datetime',];

    ############################# Relationships #############################
    public function styles(){
        return $this -> hasMany('App\Models\Style', 'user_id', 'id');
    }

    public function styleRating(){
        return $this -> hasOne('App\Models\StyleRating', 'user_id', 'id');
    }

    public function payStatus(){
        return $this -> hasOne('App\Models\PayStatus', 'user_id', 'id');
    }
}
