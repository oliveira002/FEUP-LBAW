<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SellerReport;
use App\Models\AuctionReport;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReportPolicy
{
    use HandlesAuthorization;

    public function before(?User $user,$ability)
    {        
        return null;
    }

    public function create(?User $user)
    {
      exit();
      if(Auth::guard('admin')->check()){
        return false;
      }
        return true;
    }

    public function update(?User $user)
    {
      if(Auth::guard('admin')->check()){
        return true;
      }
        return false;
    }
}
