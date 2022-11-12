<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Auction
 * 
 * @property int $idauction
 * @property string $name
 * @property Carbon $startdate
 * @property Carbon $enddate
 * @property float $startingprice
 * @property float $currentprice
 * @property string $description
 * @property bool $isover
 * @property int $idcategory
 * @property int $idowner
 * @property tsvector|null $tsvectors
 * 
 * @property Category $category
 * @property Auctionowner $auctionowner
 * @property Collection|Bid[] $bids
 * @property Collection|Favoriteauction[] $favoriteauctions
 * @property Collection|Auctionreport[] $auctionreports
 * @property Collection|Auctionlog[] $auctionlogs
 *
 * @package App\Models
 */
class Auction extends Model
{
	protected $table = 'auction';
	public $timestamps = false;

	protected $casts = [
		'startingprice' => 'float',
		'currentprice' => 'float',
		'isover' => 'bool',
		'idcategory' => 'int',
		'idowner' => 'int',
		'tsvectors' => 'tsvector'
	];

	protected $dates = [
		'startdate',
		'enddate'
	];

	protected $fillable = [
		'name',
		'startdate',
		'enddate',
		'startingprice',
		'currentprice',
		'description',
		'isover',
		'idcategory',
		'idowner',
		'tsvectors'
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'idcategory')
					->where('category.idcategory', '=', 'auction.idcategory')
					->where('category.idcategory', '=', 'auction.idcategory');
	}

	public function auctionowner()
	{
		return $this->belongsTo(Auctionowner::class, 'idowner')
					->where('auctionowner.idclient', '=', 'auction.idowner')
					->where('auctionowner.idclient', '=', 'auction.idowner');
	}

	public function bids()
	{
		return $this->hasMany(Bid::class, 'idauction');
	}

	public function favoriteauctions()
	{
		return $this->hasMany(Favoriteauction::class, 'idauction');
	}

	public function auctionreports()
	{
		return $this->hasMany(Auctionreport::class, 'idauction');
	}

	public function auctionlogs()
	{
		return $this->hasMany(Auctionlog::class, 'idauction');
	}
}
