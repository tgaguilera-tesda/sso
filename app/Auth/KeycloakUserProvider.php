<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class KeycloakUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return \App\Models\User::find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Not needed for Keycloak (stateless)
    }

    public function retrieveByCredentials(array $credentials)
    {
        // This is where the Keycloak profile comes in
        $profile = $credentials;

        if (!isset($profile['email'])) {
            return null;
        }

        // Use your custom sync method
        return \App\Auth\KeycloakUser::syncWithKeycloakProfile($profile);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Keycloak already validated credentials (token-based)
        return true;
    }
    public function rehashPasswordIfRequired(\Illuminate\Contracts\Auth\Authenticatable $user, array $credentials, bool $force = false): void
    {
        // Since Keycloak handles authentication externally,
        // there’s no password rehashing needed here.
    }

}
