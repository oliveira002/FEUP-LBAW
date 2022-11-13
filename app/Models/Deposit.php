<?php



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

	public function user()
	{
		return $this->belongsTo(User::class, 'idclient')
					->where('User.idclient', '=', 'deposit.idclient')
					->where('User.idclient', '=', 'deposit.idclient');
	}
}
