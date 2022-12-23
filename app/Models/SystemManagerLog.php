<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class SystemManagerLog extends Model
{
    public $timestamps  = false;
    protected $table = 'systemmanagerlog';
    protected $primaryKey = 'idsyslog';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logdate','logdescription','idsysman', 'logtype',
    ];

    protected $casts = [
        'logdate' => 'datetime',
    ];

    /**
     * The admin
     */
    public function admin() {
        return $this->belongsTo('App\Models\SystemManager', 'idSysMan' , 'idSysMan');
    }

    /**
     * The logs of an auction
     */
    public function auctionLog() {
        return $this->hasMany('App\Models\AuctionLog', 'idSysLog' , 'idSysLog');
    }

    /**
     * The logs of an user
     */
    public function userLog() {
        return $this->hasMany('App\Models\UserLog', 'idSysLog' , 'idSysLog');
    }

}
