<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Auctionowner
 * 
 * @property int $idclient
 * @property float|null $rating
 * 
 * @property Client $client
 * @property Collection|Review[] $reviews
 * @property Collection|Sellerreport[] $sellerreports
 * @property Collection|Auction[] $auctions
 *
 * @package App\Models
 */
class Auctionowner extends Model
{
	protected $table = 'auctionowner';
	public $timestamps = false;

	protected $casts = [
		'rating' => 'float'
	];

	protected $fillable = [
		'rating'
	];

	public function client()
	{
		return $this->belongsTo(Client::class, 'idclient')
					->where('client.idclient', '=', 'auctionowner.idclient')
					->where('client.idclient', '=', 'auctionowner.idclient');
	}

	public function reviews()
	{
		return $this->hasMany(Review::class, 'iduserreviewed');
	}

	public function sellerreports()
	{
		return $this->hasMany(Sellerreport::class, 'idseller');
	}

	public function auctions()
	{
		return $this->hasMany(Auction::class, 'idowner');
	}
}
