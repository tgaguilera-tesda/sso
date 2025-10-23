<?php

namespace App\Auth;

use App\Models\User; // your existing Eloquent model
use Vizir\KeycloakWebGuard\Models\KeycloakUser as BaseKeycloakUser;

class KeycloakUser extends BaseKeycloakUser
{
    /**
     * Map Keycloak attributes to your local user model.
     */
    public static function syncWithKeycloakProfile(array $profile)
    {
        // Match existing user or create new one based on email
        return User::where('email', $profile['email'])->first();
    }
}
