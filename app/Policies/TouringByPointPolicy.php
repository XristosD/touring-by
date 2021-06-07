<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TouringBy;
use App\Models\TouringByPoint;
use Illuminate\Auth\Access\HandlesAuthorization;

class TouringByPointPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, TouringByPoint $touringByPoint)
    {
        return $touringByPoint->touringBy->user->is($user);
    }

    public function getImage(User $user, TouringByPoint $touringByPoint){
        return $touringByPoint->touringBy->user->is($user) || DB::table('shared_touring_bies')
                                                                ->where('user_id','=',$user->id)
                                                                ->where('touring_by_id','=',$touringByPoint->touringBy->id)
                                                                ->exists();
    }
}
