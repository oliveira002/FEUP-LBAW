<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @mixin \Eloquent
 */
class AuctionReport extends Model
{
    public $timestamps  = false;
    protected $table = 'auctionreport';
    protected $primaryKey = 'idreport';

    protected $fillable = [
		'reportdate',
		'description',
		'issolved',
		'idauction',
		'idreporter'
	];

    protected $casts = [
        'reportdate' => 'timestamp',
        'issolved' => 'boolean',
        'idauction' => 'integer',
        'idreporter' => 'integer',
    ];

    /**
     * The auctions
     */
    public function auction() {
        return $this->belongsTo('App\Models\Auction', 'idAuction' , 'idAuction');
    }

    /**
     * The client
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'idClient' , 'idReporter');
    }

}
