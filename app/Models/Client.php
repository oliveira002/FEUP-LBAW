<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    protected $table = 'Client';
    protected $primaryKey = 'idClient';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'firstName', 'lastName', 'address', 'phoneNumber', 'balance', 'isBanned',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'isBanned' => 'boolean',
        'balance' => 'float',
    ];

    /**
     * The notifications of a user
     */
     public function notifications() {
      return $this->hasMany('App\Models\Notification', 'idClient' , 'idClient');
    }

    /**
     * The bids of a user
     */
    public function bids() {
        return $this->hasMany('App\Models\Bid', 'idClient' , 'idClient');
    }

    /**
     * The deposits of a user
     */
    public function deposits() {
        return $this->hasMany('App\Models\Deposit', 'idClient' , 'idClient');
    }

    /**
     * The admin logs related to the user
     */
    public function userLogs() {
        return $this->hasMany('App\Models\UserLog', 'idClient' , 'idClient');
    }

    /**
     * The auction reports the user made
     */
    public function auctionReports() {
        return $this->hasMany('App\Models\AuctionReport', 'idReporter' , 'idClient');
    }

     /**
     * The seller reports the user made
     */
    public function sellerReports() {
        return $this->hasMany('App\Models\SellerReport', 'idReporter' , 'idClient');
    }

    /**
     * The reviews the user made
     */
    public function reviews() {
        return $this->hasMany('App\Models\Review', 'idUserReviewer' , 'idClient');
    }

    /**
     * The favorite auctions of the user
     */
    public function favAuctions() {
        return $this->hasMany('App\Models\FavouriteAuction', 'idClient' , 'idClient');
    }

}
