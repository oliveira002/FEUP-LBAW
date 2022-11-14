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
    protected $table = 'auctionReport';
    protected $primaryKey = 'idReport';

    protected $fillable = [
		'reportDate',
		'description',
		'isSolved',
		'idAuction',
		'idReporter'
	];

    protected $casts = [
        'reportDate' => 'timestamp',
        'isSolved' => 'boolean',
        'idAuction' => 'integer',
        'idReporter' => 'integer',
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
