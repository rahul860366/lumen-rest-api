<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{

    public function groups()
    {
        return $this->hasMany('App\Group', 'id', 'group_id');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


}
