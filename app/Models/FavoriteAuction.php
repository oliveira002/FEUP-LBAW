<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class FavoriteAuction extends Model
{
    public $timestamps  = false;
    protected $table = 'favoriteAuction';
    protected $primaryKey = 'idAuction';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idClient',
    ];

    protected $casts = [
        'idClient' => 'integer',
    ];

    /**
     * The person
     */
    public function user() {
        return $this->belongsTo('App\Models\User','idClient','idClient');
    }

    /**
     * The auction
     */
    public function auction() {
        return $this->belongsTo('App\Models\Auction','idAuction','idAuction');
    }
}
