<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class SellerReport extends Model
{
    public $timestamps  = false;
    protected $table = 'sellerreport';
    protected $primaryKey = 'idreport';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idreport','reportdate', 'description', 'issolved', 'idseller', 'idreporter',
    ];

    protected $casts = [
        'issolved' => 'boolean',
        'reportdate' => 'datetime',
        'idseller' => 'integer',
        'idreporter' => 'integer',
    ];

     /**
     * The person who made the report
     */
    public function user() {
        return $this->belongsTo('App\Models\User','idClient','idReporter');
    }

     /**
     * The person reported
     */
    public function auctionOwner() {
        return $this->belongsTo('App\Models\AuctionOwner','idClient','idSeller');
    }

}
