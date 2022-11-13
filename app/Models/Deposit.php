<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    public $timestamps  = false;
    protected $table = 'Deposit';
    protected $primaryKey = 'idDeposit';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'method', 'depositDate', 'idClient',
    ];

    protected $casts = [
        'amount' => 'float',
        'depositDate' => 'timestamp',
        'idClient' => 'integer',
    ];

    /**
     * The person who made the deposit
     */
    public function client() {
        return $this->belongsTo('App\Models\Client','idClient','idClient');
    }
}
