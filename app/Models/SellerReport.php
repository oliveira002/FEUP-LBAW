<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerReport extends Model
{
    public $timestamps  = false;
    protected $table = 'sellerReport';
    protected $primaryKey = 'idReport';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reportDate', 'description', 'isSolved', 'idSeller', 'idReporter',
    ];

    protected $casts = [
        'isSolved' => 'boolean',
        'reportDate' => 'timestamp',
        'idSeller' => 'integer',
        'idReporter' => 'integer',
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
