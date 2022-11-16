<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class DeletedUser extends Model
{
    public $timestamps  = false;
    protected $table = 'deleteduser';
    protected $primaryKey = 'idclient';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
    ];
}
