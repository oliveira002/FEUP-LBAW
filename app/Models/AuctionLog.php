<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class AuctionLog extends Model
{
    public $timestamps  = false;
    protected $table = 'auctionLog';
    protected $primaryKey = 'idsyslog';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idauction',
    ];

    protected $casts = [
        'idauction' => 'integer',
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
    public function auction() {
        return $this->belongsTo('App\Models\Auction', 'idAuction' , 'idAuction');
    }

}
