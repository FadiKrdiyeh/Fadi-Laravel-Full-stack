<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    protected $table = 'styles';
    protected $fillable = ['title', 'description', 'html_code', 'css_code', 'js_code', 'media', 'user_id', 'style_rate', 'pays_count'];
    protected $hidden = ['updated_at',];
    public $timestamps = true;

    ############################# Relationships #############################
    public function styleRating(){
        return $this -> hasMany('App\Models\StyleRating', 'style_id', 'id');
    }

    public function payStatus(){
        return $this -> hasMany('App\Models\PayStatus', 'style_id', 'id');
    }

    public function user(){
        return $this -> belongsTo('App\Models\User', 'user_id', 'id');
    }
}
