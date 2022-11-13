<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Client
 * 
 * @property int $idclient
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string|null $address
 * @property string|null $phonenumber
 * @property bool $isbanned
 * @property float $balance
 * 
 * @property Auctionowner $auctionowner
 * @property Collection|Review[] $reviews
 * @property Collection|Bid[] $bids
 * @property Collection|Favoriteauction[] $favoriteauctions
 * @property Collection|Sellerreport[] $sellerreports
 * @property Collection|Auctionreport[] $auctionreports
 * @property Collection|Deposit[] $deposits
 * @property Collection|Notification[] $notifications
 * @property Collection|Userlog[] $userlogs
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    protected $table = 'user';
    protected $primaryKey = 'idClient';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'firstName', 'lastName', 'address', 'phoneNumber', 'balance', 'isBanned',
    ];

	protected $hidden = [
		'password'
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
