<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemManagerLog extends Model
{
    public $timestamps  = false;
    protected $table = 'systemManagerLog';
    protected $primaryKey = 'idSysLog';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logDate','logDescription','idSysMan', 'logType',
    ];

    protected $casts = [
        'logDate' => 'timestamp',
        'idSysMan' => 'logType',
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
    public function userrLog() {
        return $this->hasMany('App\Models\UserLog', 'idSysLog' , 'idSysLog');
    }

}
