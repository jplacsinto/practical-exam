<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $adminId = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'contact_no', 'birthday', 'role_id', 'email', 'password', 'created_by', 'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*
    Laratables
     */
    
    public static function laratablesAdditionalColumns()
    {
        return ['first_name', 'last_name', 'role_id'];
    }

    public static function laratablesCustomName($user)
    {
        return $user->first_name.' '.$user->last_name;
    }

    public static function laratablesOrderName()
    {
        return 'first_name';
    }

    public static function laratablesSearchName($query, $searchValue)
    {
        return $query->orWhere('first_name', 'like', '%'. $searchValue. '%')
            ->orWhere('last_name', 'like', '%'. $searchValue. '%')
        ;
    }

    public static function laratablesCustomRoleId($user)
    {
        return $user->role_id === 1 ? "Admin" : "Client";
    }

    public static function laratablesCustomAction($user)
    {
        return view('action', compact('user'))->render();
    }
    /**/


    public function isAdmin()
    {
        return $this->role_id === $this->adminId;
    }

    public function interests()
    {
        return $this->belongsToMany('App\Interest', 'client_interests', 'user_id', 'interest_id');
    }
}
