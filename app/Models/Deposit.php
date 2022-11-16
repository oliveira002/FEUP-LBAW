<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Deposit extends Model
{
    public $timestamps  = false;
    protected $table = 'deposit';
    protected $primaryKey = 'iddeposit';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'method', 'depositdate', 'idclient',
    ];

    protected $casts = [
        'amount' => 'float',
        'depositdate' => 'datetime',
        'idclient' => 'integer',
    ];

    /**
     * The person who made the deposit
     */
    public function user() {
        return $this->belongsTo('App\Models\User','idClient','idClient');
    }
}
