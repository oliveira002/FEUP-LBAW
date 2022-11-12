<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Auctionlog
 * 
 * @property int $idsyslog
 * @property int $idauction
 * 
 * @property Systemmanagerlog $systemmanagerlog
 * @property Auction $auction
 *
 * @package App\Models
 */
class Auctionlog extends Model
{
	protected $table = 'auctionlog';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idsyslog' => 'int',
		'idauction' => 'int'
	];

	public function systemmanagerlog()
	{
		return $this->belongsTo(Systemmanagerlog::class, 'idsyslog')
					->where('systemmanagerlog.idsyslog', '=', 'auctionlog.idsyslog')
					->where('systemmanagerlog.idsyslog', '=', 'auctionlog.idsyslog');
	}

	public function auction()
	{
		return $this->belongsTo(Auction::class, 'idauction')
					->where('auction.idauction', '=', 'auctionlog.idauction')
					->where('auction.idauction', '=', 'auctionlog.idauction');
	}
}
