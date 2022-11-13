<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Auctionreport
 * 
 * @property int $idreport
 * @property Carbon $reportdate
 * @property string $description
 * @property bool $issolved
 * @property int $idauction
 * @property int $idreporter
 * 
 * @property Auction $auction
 * @property Client $client
 *
 * @package App\Models
 */
class Auctionreport extends Model
{
	protected $table = 'auctionreport';
	public $timestamps = false;

	protected $casts = [
		'issolved' => 'bool',
		'idauction' => 'int',
		'idreporter' => 'int'
	];

	protected $dates = [
		'reportdate'
	];

	protected $fillable = [
		'reportdate',
		'description',
		'issolved',
		'idauction',
		'idreporter'
	];

	public function auction()
	{
		return $this->belongsTo(Auction::class, 'idauction')
					->where('auction.idauction', '=', 'auctionreport.idauction')
					->where('auction.idauction', '=', 'auctionreport.idauction');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'idreporter')
					->where('User.idclient', '=', 'auctionreport.idreporter')
					->where('User.idclient', '=', 'auctionreport.idreporter');
	}
}
