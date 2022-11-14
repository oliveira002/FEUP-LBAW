<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class SystemManager extends Model
{
    public $timestamps  = false;
    protected $table = 'systemManager';
    protected $primaryKey = 'idSysMan';

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
