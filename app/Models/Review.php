<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Review extends Model
{
    public $timestamps  = false;
    protected $table = 'review';
    protected $primaryKey = 'idreview';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idreview','rating', 'comment', 'reviewDate', 'iduserreviewer', 'iduserreviewed',
    ];

    protected $casts = [
        'rating' => 'float',
        'reviewdate' => 'datetime',
        'iduserreviewer' => 'integer',
        'iduserreviewed' => 'integer',
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
