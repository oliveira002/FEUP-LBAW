<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sellerreport
 * 
 * @property int $idreport
 * @property Carbon $reportdate
 * @property string $description
 * @property bool $issolved
 * @property int $idseller
 * @property int $idreporter
 * 
 * @property Auctionowner $auctionowner
 * @property Client $client
 *
 * @package App\Models
 */
class Sellerreport extends Model
{
	protected $table = 'sellerreport';
	public $timestamps = false;

	protected $casts = [
		'issolved' => 'bool',
		'idseller' => 'int',
		'idreporter' => 'int'
	];

	protected $dates = [
		'reportdate'
	];

	protected $fillable = [
		'reportdate',
		'description',
		'issolved',
		'idseller',
		'idreporter'
	];

	public function auctionowner()
	{
		return $this->belongsTo(Auctionowner::class, 'idseller')
					->where('auctionowner.idclient', '=', 'sellerreport.idseller')
					->where('auctionowner.idclient', '=', 'sellerreport.idseller');
	}

	public function client()
	{
		return $this->belongsTo(Client::class, 'idreporter')
					->where('client.idclient', '=', 'sellerreport.idreporter')
					->where('client.idclient', '=', 'sellerreport.idreporter');
	}
}
