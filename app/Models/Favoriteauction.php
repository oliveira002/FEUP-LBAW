<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Favoriteauction
 * 
 * @property int $idclient
 * @property int $idauction
 * 
 * @property Client $client
 * @property Auction $auction
 *
 * @package App\Models
 */
class Favoriteauction extends Model
{
	protected $table = 'favoriteauction';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idclient' => 'int',
		'idauction' => 'int'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idclient')
					->where('User.idclient', '=', 'favoriteauction.idclient')
					->where('User.idclient', '=', 'favoriteauction.idclient');
	}

	public function auction()
	{
		return $this->belongsTo(Auction::class, 'idauction')
					->where('auction.idauction', '=', 'favoriteauction.idauction')
					->where('auction.idauction', '=', 'favoriteauction.idauction');
	}
}
