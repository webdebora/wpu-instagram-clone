<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Photo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
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
    // app/Policies/PhotoPolicy.php
    public function update(User $user, Photo $photo)
    {
        // Izinkan hanya pemilik foto yang bisa mengedit
        return $user->id === $photo->user_id;
    }


public function delete(User $user, Photo $photo)
{
    return $user->id === $photo->user_id; // Hanya pemilik foto yang bisa menghapusnya
}

}
