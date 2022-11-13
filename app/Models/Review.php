<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps  = false;
    protected $table = 'review';
    protected $primaryKey = 'idReview';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating', 'comment', 'reviewDate', 'idUserReviewer', 'idUserReviewed',
    ];

    protected $casts = [
        'rating' => 'float',
        'reviewDate' => 'timestamp',
        'idUserReviewer' => 'integer',
        'idUserReviewed' => 'integer',
    ];

    /**
     * The person who made the review
     */
    public function user() {
        return $this->belongsTo('App\Models\User','idClient','idUserReviewer');
    }

     /**
     * The person reviewed
     */
    public function auctionOwner() {
        return $this->belongsTo('App\Models\AuctionOwner','idClient','idUserReviewed');
    }
}
