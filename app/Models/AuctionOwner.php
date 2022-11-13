<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionOwner extends Model
{
    public $timestamps  = false;
    protected $table = 'AuctionOwner';
    protected $primaryKey = 'idClient';

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
    public function client() {
        return $this->belongsTo('App\Models\Client', 'idClient' , 'idClient');
    }

}
