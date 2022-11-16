<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Category extends Model
{
    public $timestamps  = false;
    protected $table = 'category';
    protected $primaryKey = 'idcategory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

     /**
     * Category of an auction
     */
    public function auction() {
        return $this->hasMany('App\Models\Auction', 'idCategory' , 'idCategory');
    }
}
