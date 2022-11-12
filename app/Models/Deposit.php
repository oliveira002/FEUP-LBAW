<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Deposit
 * 
 * @property int $iddeposit
 * @property float $amount
 * @property string $method
 * @property Carbon $depositdate
 * @property int $idclient
 * 
 * @property Client $client
 *
 * @package App\Models
 */
class Deposit extends Model
{
	protected $table = 'deposit';
	public $timestamps = false;

	protected $casts = [
		'amount' => 'float',
		'idclient' => 'int'
	];

	protected $dates = [
		'depositdate'
	];

	protected $fillable = [
		'amount',
		'method',
		'depositdate',
		'idclient'
	];

	public function client()
	{
		return $this->belongsTo(Client::class, 'idclient')
					->where('client.idclient', '=', 'deposit.idclient')
					->where('client.idclient', '=', 'deposit.idclient');
	}
}
