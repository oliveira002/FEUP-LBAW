<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class UserLog extends Model
{
    public $timestamps  = false;
    protected $table = 'userlog';
    protected $primaryKey = 'idsyslog';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idclient',
    ];

    protected $casts = [
        'idclient' => 'integer',
    ];

    /**
     * The sysLog of an auction
     */
    public function systemManagerLog() {
        return $this->belongsTo('App\Models\SystemManagerLog', 'idSysLog' , 'idSysLog');
    }

    /**
     * The sysLog of an auction
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'idClient' , 'idClient');
    }
}
