<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * 
 * @property int $idreview
 * @property int $rating
 * @property string|null $comment
 * @property Carbon $reviewdate
 * @property int $iduserreviewer
 * @property int $iduserreviewed
 * 
 * @property Client $client
 * @property Auctionowner $auctionowner
 *
 * @package App\Models
 */
class Review extends Model
{
	protected $table = 'review';
	public $timestamps = false;

	protected $casts = [
		'rating' => 'int',
		'iduserreviewer' => 'int',
		'iduserreviewed' => 'int'
	];

	protected $dates = [
		'reviewdate'
	];

	protected $fillable = [
		'rating',
		'comment',
		'reviewdate',
		'iduserreviewer',
		'iduserreviewed'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'iduserreviewer')
					->where('User.idclient', '=', 'review.iduserreviewer')
					->where('User.idclient', '=', 'review.iduserreviewer');
	}

	public function auctionowner()
	{
		return $this->belongsTo(Auctionowner::class, 'iduserreviewed')
					->where('auctionowner.idclient', '=', 'review.iduserreviewed')
					->where('auctionowner.idclient', '=', 'review.iduserreviewed');
	}
}
