<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $idcategory
 * @property string $name
 * 
 * @property Collection|Auction[] $auctions
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'category';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function auctions()
	{
		return $this->hasMany(Auction::class, 'idcategory');
	}
}
