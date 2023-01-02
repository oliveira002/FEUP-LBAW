<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword as Resetable;

/**
 * @mixin \Eloquent
 */
class User extends Authenticatable implements Resetable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    protected $table = 'user';
    protected $primaryKey = 'idclient';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idclient', 'username', 'email', 'password', 'firstname', 'lastname', 'address', 'phonenumber', 'balance', 'isbanned',
    ];

	protected $hidden = [
		'password'
	];

    protected $casts = [
        'isbanned' => 'boolean',
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

    /**
     * The auction owner
     */
    public function auctionOwner() {
        return $this->hasOne('App\Models\AuctionOwner', 'idClient' , 'idClient');
    }

    public static function searchUser($search)
    {
        return User::query()->orWhere('username', 'ilIKE', "%{$search}%")
        ->orWhere('firstname', 'ilIKE', "%{$search}%")
        ->orWhere('lastname', 'ilIKE', "%{$search}%")
        ->orWhere('email', 'ilIKE', "%{$search}%");
    }

}
