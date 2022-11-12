<?php

/**
 * Created by Reliese Model.
 */

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

	public function client()
	{
		return $this->belongsTo(Client::class, 'idclient')
					->where('client.idclient', '=', 'favoriteauction.idclient')
					->where('client.idclient', '=', 'favoriteauction.idclient');
	}

	public function auction()
	{
		return $this->belongsTo(Auction::class, 'idauction')
					->where('auction.idauction', '=', 'favoriteauction.idauction')
					->where('auction.idauction', '=', 'favoriteauction.idauction');
	}
}
