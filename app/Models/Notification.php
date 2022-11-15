<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Notification extends Model
{
    public $timestamps  = false;
    protected $table = 'notification';
    protected $primaryKey = 'idnotification';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'isread', 'notifdate', 'idclient',
    ];

    protected $casts = [
        'isread' => 'boolean',
        'notifdate' => 'datetime',
        'idclient' => 'integer',
    ];

    /**
     * The person of the notification
     */
    public function user() {
        return $this->belongsTo('App\Models\User','idClient','idClient');
    }
}
