<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
class Client extends Model
{
	protected $table = 'client';
	public $timestamps = false;

	protected $casts = [
		'isbanned' => 'bool',
		'balance' => 'float'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'email',
		'firstname',
		'lastname',
		'address',
		'phonenumber',
		'isbanned',
		'balance'
	];

	public function auctionowner()
	{
		return $this->hasOne(Auctionowner::class, 'idclient');
	}

	public function reviews()
	{
		return $this->hasMany(Review::class, 'iduserreviewer');
	}

	public function bids()
	{
		return $this->hasMany(Bid::class, 'idclient');
	}

	public function favoriteauctions()
	{
		return $this->hasMany(Favoriteauction::class, 'idclient');
	}

	public function sellerreports()
	{
		return $this->hasMany(Sellerreport::class, 'idreporter');
	}

	public function auctionreports()
	{
		return $this->hasMany(Auctionreport::class, 'idreporter');
	}

	public function deposits()
	{
		return $this->hasMany(Deposit::class, 'idclient');
	}

	public function notifications()
	{
		return $this->hasMany(Notification::class, 'idclient');
	}

	public function userlogs()
	{
		return $this->hasMany(Userlog::class, 'idclient');
	}
}
