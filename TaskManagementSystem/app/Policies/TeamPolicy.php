<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        return ($user->MemberOfTeam($team->id) || $user->id == $team->maneger_id && $user->IsManeger() || $user->IsOwner());
        // return $user->MemberOfTeam($team->id);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return ($user->role == $user->IsManeger() || $user->role == $user->IsOwner());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Team $team): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): bool
    {
        //
    }

    public function removeMember(User $user , Team $team)
    {
        return ($user->IsManeger() && $user->id == $team->maneger_id);
    }
    
    public function canInvite(User $user , Team $team)
    {
        return ($user->IsManeger() && $user->id == $team->maneger_id);
    }
}