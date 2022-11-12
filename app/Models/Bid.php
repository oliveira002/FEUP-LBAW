<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bid
 * 
 * @property int $idbid
 * @property Carbon $biddate
 * @property bool $isvalid
 * @property float $price
 * @property int $idclient
 * @property int $idauction
 * 
 * @property Client $client
 * @property Auction $auction
 *
 * @package App\Models
 */
class Bid extends Model
{
	protected $table = 'bid';
	public $timestamps = false;

	protected $casts = [
		'isvalid' => 'bool',
		'price' => 'float',
		'idclient' => 'int',
		'idauction' => 'int'
	];

	protected $dates = [
		'biddate'
	];

	protected $fillable = [
		'biddate',
		'isvalid',
		'price',
		'idclient',
		'idauction'
	];

	public function client()
	{
		return $this->belongsTo(Client::class, 'idclient')
					->where('client.idclient', '=', 'bid.idclient')
					->where('client.idclient', '=', 'bid.idclient');
	}

	public function auction()
	{
		return $this->belongsTo(Auction::class, 'idauction')
					->where('auction.idauction', '=', 'bid.idauction')
					->where('auction.idauction', '=', 'bid.idauction');
	}
}
