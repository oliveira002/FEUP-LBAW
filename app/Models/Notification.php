<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps  = false;
    protected $table = 'Notification';
    protected $primaryKey = 'idNotification';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'isRead', 'notifDate', 'idClient',
    ];

    protected $casts = [
        'isRead' => 'boolean',
        'notifDate' => 'timestamp',
        'idClient' => 'integer',
    ];

    /**
     * The person of the notification
     */
    public function client() {
        return $this->belongsTo('App\Models\Client','idClient','idClient');
    }
}
