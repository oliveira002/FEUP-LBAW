<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * 
 * @property int $idnotification
 * @property string $content
 * @property bool $isread
 * @property Carbon $notifdate
 * @property int $idclient
 * 
 * @property Client $client
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notification';
	public $timestamps = false;

	protected $casts = [
		'isread' => 'bool',
		'idclient' => 'int'
	];

	protected $dates = [
		'notifdate'
	];

	protected $fillable = [
		'content',
		'isread',
		'notifdate',
		'idclient'
	];

	public function client()
	{
		return $this->belongsTo(Client::class, 'idclient')
					->where('client.idclient', '=', 'notification.idclient')
					->where('client.idclient', '=', 'notification.idclient');
	}
}
