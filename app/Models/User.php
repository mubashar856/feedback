<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasRole($role){
        return User::where('role', '$role')->get();
    }

    public function teacher(){
        return $this->hasOne(Teacher::class);
    }
//    public function getRoleAttribute($value, $role)
//    {
//        if ($value == $role){
//            return true;
//        }else{
//            return false;
//        }
//    }

}
