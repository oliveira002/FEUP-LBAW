<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;


/**
 * App\Models\Auction
 *
 * @mixin \Eloquent
 */
class Auction extends Model
{
    public $timestamps  = false;
    protected $table = 'auction';
    protected $primaryKey = 'idauction';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idauction', 'name', 'startdate', 'enddate', 'startingprice', 'currentprice', 'description', 'isover', 'idcategory', 'idowner',
    ];

    protected $casts = [
        'startdate' => 'datetime',
        'enddate' => 'datetime',
        'startprice' => 'float',
        'currentprice' => 'float',
        'isover' => 'boolean',
        'idcategory' => 'integer',
        'idowner' => 'integer',
    ];

    /**
     * The bids of an auction
     */
    public function bids() {
        return $this->hasMany('App\Models\Bid', 'idAuction' , 'idAuction');
    }

     /**
     * The owner of the auction
     */
    public function auctionOwner() {
        return $this->belongsTo('App\Models\AuctionOwner','idClient','idOwner');
    }

    /**
     * Reports of the auction
     */
    public function auctionReports() {
        return $this->hasMany('App\Models\AuctionReport','idAuction','idAuction');
    }

    /**
     * Logs related to the auction
     */
    public function auctionLogs() {
        return $this->hasMany('App\Models\AuctionLog','idAuction','idAuction');
    }

    /**
     * The category of the auction
     */
    public function category() {
        return $this->belongsTo('App\Models\Category','idCategory','idCategory');
    }

     /**
     * Favorite auctions
     */
    public function favAuction() {
        return $this->hasMany('App\Models\FavoriteAuction','idAuction','idAuction');
    }

    public static function ftsSearch($search)
    {
        return Auction::whereRaw('(tsvectors @@ websearch_to_tsquery(\'english\', ?) OR (name ilike ? OR description ilike ?))', 
        [$search,'%' . $search . '%','%' .$search . '%'])
            ->orderByRaw('ts_rank(tsvectors, websearch_to_tsquery(\'english\', ?)) DESC', [$search]);
    }

    public static function ftsSearchCat($search,$cat)
    {
        return Auction::whereRaw('(tsvectors @@ websearch_to_tsquery(\'english\', ?) OR (name ilike ? OR description ilike ?)) AND idcategory = ?',
            [$search,'%' . $search . '%','%' .$search . '%',$cat])
            ->orderByRaw('ts_rank(tsvectors, websearch_to_tsquery(\'english\', ?)) DESC', [$search]);
    }

    public static function searchWithUser($search)
    {
        return DB::table('auction')
            ->join("user", 'user.idclient', '=', 'auction.idowner')
            ->select('*','user.username')
            ->whereRaw('tsvectors @@ websearch_to_tsquery(\'english\', ?)', [$search])
            ->orWhere('name', 'ilike', '%' . $search . '%')
            ->orWhere('description', 'ilike', '%' . $search . '%')
            ->whereRaw('auction.isover = false')
            ->whereRaw('auction.idowner = "user".idclient')
            ->orderByRaw('ts_rank(tsvectors, websearch_to_tsquery(\'english\', ?)) DESC', [$search]);
    }
    public static function getAll()
    {
        return DB::table('auction')
            ->join("user", 'user.idclient', '=', 'auction.idowner')
            ->select('*','user.username')
            ->whereRaw('auction.isover = false')
            ->whereRaw('auction.idowner = "user".idclient')
            ->orderBy('auction.idauction', 'ASC');
    }
}
