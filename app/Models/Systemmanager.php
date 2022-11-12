<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Systemmanager
 * 
 * @property int $idsysman
 * @property string $username
 * @property string $email
 * @property string $password
 * 
 * @property Collection|Systemmanagerlog[] $systemmanagerlogs
 *
 * @package App\Models
 */
class Systemmanager extends Model
{
	protected $table = 'systemmanager';
	public $timestamps = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'email',
		'password'
	];

	public function systemmanagerlogs()
	{
		return $this->hasMany(Systemmanagerlog::class, 'idsysman');
	}
}
