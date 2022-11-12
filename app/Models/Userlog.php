<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Userlog
 * 
 * @property int $idsyslog
 * @property int $idclient
 * 
 * @property Systemmanagerlog $systemmanagerlog
 * @property Client $client
 *
 * @package App\Models
 */
class Userlog extends Model
{
	protected $table = 'userlog';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idsyslog' => 'int',
		'idclient' => 'int'
	];

	public function systemmanagerlog()
	{
		return $this->belongsTo(Systemmanagerlog::class, 'idsyslog')
					->where('systemmanagerlog.idsyslog', '=', 'userlog.idsyslog')
					->where('systemmanagerlog.idsyslog', '=', 'userlog.idsyslog');
	}

	public function client()
	{
		return $this->belongsTo(Client::class, 'idclient')
					->where('client.idclient', '=', 'userlog.idclient')
					->where('client.idclient', '=', 'userlog.idclient');
	}
}
