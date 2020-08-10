<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function findForPassport($username)
    {
        return $this->where('name', $username)->first();
    }



    public function projects(){
        return $this->belongsToMany('App\Project')->withTimestamps()->using('App\ProjectUser');
    }

    public function manage() {
        return $this->HasMany('App\Project', 'managed', 'id');
    }

    public function absentApplication(){
        return $this->hasMany('App\AbsentApplication');
    }

    public function sum_day_off(){
        return $this->hasMany('App\AbsentApplication')
            ->selectRaw("SUM(number_off) as num_day_off")
            ->groupBy('user_id');
    }


    public function project_user() {
        return $this->hasMany('\App\ProjectUser');
    }



    public function reports() {
        return $this->hasManyThrough(
            '\App\Report',
            '\App\ProjectUser',
            'user_id',
            'project_user_id',
            'id',
            'id'
        );
    }

    // public function time_working() {
    //     return $this->hasManyThrough(
    //         '\App\Report',
    //         '\App\ProjectUser',
    //         'user_id',
    //         'project_user_id',
    //         'id',
    //         'id'
    //     )
    //     ->leftJoin('project_user', 'users.id', "=", "project_user.user_id")
    //     ->selectRaw('sum(TIMESTAMPDIFF(hour, time_checkin, time_checkout)) as time_working, user_id')
    //     ->groupBy('user_id');
    // }



}
