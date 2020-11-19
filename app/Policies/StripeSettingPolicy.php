<?php

namespace App\Policies;

use App\Models\StripeSetting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StripeSettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StripeSetting  $stripeSetting
     * @return mixed
     */
    public function view(User $user, StripeSetting $stripeSetting)
    {
        return $user->id === $stripeSetting->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StripeSetting  $stripeSetting
     * @return mixed
     */
    public function update(User $user, StripeSetting $stripeSetting)
    {
        return $user->id === $stripeSetting->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StripeSetting  $stripeSetting
     * @return mixed
     */
    public function delete(User $user, StripeSetting $stripeSetting)
    {
        return $user->id === $stripeSetting->user_id;
    }
}
