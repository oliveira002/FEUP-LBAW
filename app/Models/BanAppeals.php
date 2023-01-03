<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class BanAppeals extends Model
{
    public $timestamps  = false;
    protected $table = 'banappeals';
    protected $primaryKey = 'idbanappeal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idbanappeal','appealdate','appealdescription','idclient',
    ];

    protected $casts = [
        'appealdate' => 'datetime',
    ];

    /**
     * The admin
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'idClient' , 'idClient');
    }

}
