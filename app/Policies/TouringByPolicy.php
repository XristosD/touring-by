<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TouringBy;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class TouringByPolicy
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

    public function update(User $user, TouringBy $touringBy){
        return $touringBy->user->is($user);
    }

    public function get(User $user, TouringBy $touringBy){
        return $touringBy->user->is($user) || DB::table('shared_touring_bies')
                                                ->where('user_id','=',$user->id)
                                                ->where('touring_by_id','=',$touringBy->id)
                                                ->exists();
    }
}
