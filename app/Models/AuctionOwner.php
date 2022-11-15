<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class AuctionOwner extends Model
{
    public $timestamps  = false;
    protected $table = 'auctionowner';
    protected $primaryKey = 'idclient';

    protected $fillable = [
        'rating',
    ];

    protected $casts = [
        'rating' => 'float',
    ];

    /**
     * The auctions
     */
    public function auction() {
        return $this->hasMany('App\Models\Auction', 'idOwner' , 'idClient');
    }

     /**
     * The reports
     */
    public function sellerReport() {
        return $this->hasMany('App\Models\SellerReport', 'idSeller' , 'idClient');
    }

     /**
     * The reviews
     */
    public function reviews() {
        return $this->hasMany('App\Models\Review', 'idUserReviewed' , 'idClient');
    }

    /**
     * The client
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'idClient' , 'idClient');
    }

}
