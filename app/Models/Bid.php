<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Bid extends Model
{
    public $timestamps  = false;
    protected $table = 'bid';
    protected $primaryKey = 'idbid';

    protected $fillable = [
        'biddate', 'isvalid', 'price', 'idclient', 'idauction',
    ];

    protected $casts = [
        'biddate' => 'datetime',
        'isvalid' => 'boolean',
        'price' => 'float',
        'idclient' => 'integer',
        'idauction' => 'integer',
    ];

    /**
     * The person who bid
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'idClient' , 'idClient');
    }

    /**
     * The auction where that was bid
     */
    public function auction() {
        return $this->belongsTo('App\Models\Auction', 'idAuction' , 'idAuction');
    }

}
