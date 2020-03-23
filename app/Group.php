<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable= ['name', 'user_id'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function group_users(){
        return $this->hasMany('App\GroupUser', 'group_id', 'id');
    }

}
