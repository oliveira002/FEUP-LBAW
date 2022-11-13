<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public $timestamps  = false;
    protected $table = 'Bid';
    protected $primaryKey = 'idBid';

    protected $fillable = [
        'bidDate', 'isValid', 'price', 'idClient', 'idAuction',
    ];

    protected $casts = [
        'bidDate' => 'timestamp',
        'isValid' => 'boolean',
        'price' => 'float',
        'idClient' => 'integer',
        'idAuction' => 'integer',
    ];

    /**
     * The person who bid
     */
    public function client() {
        return $this->belongsTo('App\Models\Client', 'idClient' , 'idClient');
    }

    /**
     * The auction where that was bid
     */
    public function auction() {
        return $this->belongsTo('App\Models\Auction', 'idAuction' , 'idAuction');
    }

}
