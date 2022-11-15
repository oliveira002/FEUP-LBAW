<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Auction
 *
 * @mixin \Eloquent
 */
class Auction extends Model
{
    public $timestamps  = false;
    protected $table = 'auction';
    protected $primaryKey = 'idauction';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'startdate', 'enddate', 'startingprice', 'currentprice', 'description', 'isover', 'idcategory', 'idowner',
    ];

    protected $casts = [
        'startdate' => 'timestamp',
        'enddate' => 'timestamp',
        'startprice' => 'float',
        'currentprice' => 'float',
        'isover' => 'boolean',
        'idcategory' => 'integer',
        'idowner' => 'integer',
    ];

    /**
     * The bids of an auction
     */
    public function bids() {
        return $this->hasMany('App\Models\Bid', 'idAuction' , 'idAuction');
    }

     /**
     * The owner of the auction
     */
    public function auctionOwner() {
        return $this->belongsTo('App\Models\AuctionOwner','idClient','idOwner');
    }

    /**
     * Reports of the auction
     */
    public function auctionReports() {
        return $this->hasMany('App\Models\AuctionReport','idAuction','idAuction');
    }

    /**
     * Logs related to the auction
     */
    public function auctionLogs() {
        return $this->hasMany('App\Models\AuctionLog','idAuction','idAuction');
    }

    /**
     * The category of the auction
     */
    public function category() {
        return $this->belongsTo('App\Models\Category','idCategory','idCategory');
    }

     /**
     * Favorite auctions
     */
    public function favAuction() {
        return $this->hasMany('App\Models\FavoriteAuction','idAuction','idAuction');
    }

}
