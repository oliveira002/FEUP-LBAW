<?php

namespace App\Policies;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class BidPolicy
{
    use HandlesAuthorization;
    public function before(?User $user,$ability)
    {        
      if(Auth::guard('admin')->check()){
        return true;
      }
        return null;
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Bid $bid)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Bid $bid)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Bid $bid)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(?User $user, Bid $bid)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(?User $user, Bid $bid)
    {
        return false;
    }
}
