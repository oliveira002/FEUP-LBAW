<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps  = false;
    protected $table = 'Category';
    protected $primaryKey = 'idCategory';

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
