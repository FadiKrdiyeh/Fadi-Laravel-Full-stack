<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StyleRating extends Model
{
    use HasFactory;

    protected $table = 'style_ratings';
    protected $fillable = ['user_id', 'style_id', 'rating',];
    public $timestamps = false;

    ############################# Relationships #############################
    public function style(){
        return $this -> belongsTo('App\Models\Style', 'style_id', 'id');
    }
    public function user(){
        return $this -> belongsTo('App\Models\User', 'user_id', 'id');
    }
}
