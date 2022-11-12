<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Deleteduser
 * 
 * @property int $idclient
 * @property string $username
 *
 * @package App\Models
 */
class Deleteduser extends Model
{
	protected $table = 'deleteduser';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idclient' => 'int'
	];

	protected $fillable = [
		'username'
	];
}
