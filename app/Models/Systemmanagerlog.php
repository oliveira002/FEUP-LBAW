<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Systemmanagerlog
 * 
 * @property int $idsyslog
 * @property Carbon $logdate
 * @property string $logdescription
 * @property string $logtype
 * @property int $idsysman
 * 
 * @property Systemmanager $systemmanager
 * @property Collection|Userlog[] $userlogs
 * @property Collection|Auctionlog[] $auctionlogs
 *
 * @package App\Models
 */
class Systemmanagerlog extends Model
{
	protected $table = 'systemmanagerlog';
	public $timestamps = false;

	protected $casts = [
		'idsysman' => 'int'
	];

	protected $dates = [
		'logdate'
	];

	protected $fillable = [
		'logdate',
		'logdescription',
		'logtype',
		'idsysman'
	];

	public function systemmanager()
	{
		return $this->belongsTo(Systemmanager::class, 'idsysman')
					->where('systemmanager.idsysman', '=', 'systemmanagerlog.idsysman')
					->where('systemmanager.idsysman', '=', 'systemmanagerlog.idsysman');
	}

	public function userlogs()
	{
		return $this->hasMany(Userlog::class, 'idsyslog');
	}

	public function auctionlogs()
	{
		return $this->hasMany(Auctionlog::class, 'idsyslog');
	}
}
