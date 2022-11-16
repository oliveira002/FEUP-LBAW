<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @mixin \Eloquent
 */
class SystemManager extends Authenticatable
{
    public $timestamps  = false;
    protected $table = 'systemmanager';
    protected $primaryKey = 'idsysman';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','email','password'
    ];

    protected $hidden = [
		'password'
	];

    /**
     * The logs of an admin
     */
    public function logs() {
        return $this->hasMany('App\Models\SystemManagerLog', 'idSysMan' , 'idSysMan');
    }

}
