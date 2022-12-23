<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    public function before(?User $user,$ability)
    {        
      if(Auth::guard('admin')->check()){
        return true;
      }
        return null;
    }

    public function create(?User $user)
    {
        return true;
    }

    public function update(?User $user)
    {
        return false;
    }
}
