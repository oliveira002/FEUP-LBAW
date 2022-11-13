<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionReport extends Model
{
    public $timestamps  = false;
    protected $table = 'AuctionReport';
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
    public function client() {
        return $this->belongsTo('App\Models\Client', 'idClient' , 'idReporter');
    }

}
