<?php


namespace App\Providers;

use App\Models\UserEmailAlias;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

/**
 * Da soporte para el inicio de sesión con múltiples emails
 *
 * Class EloquentUserEmailAliasProvider
 * @package App\Providers
 */
class EloquentUserEmailAliasProvider extends EloquentUserProvider
{

    /**
     * Retrieve a user by the given credentials with support email aliases
     *
     * @param  array  $credentials
     * @return UserContract|null
     */
    public function retrieveByCredentials(array $credentials) : UserContract | null
    {

        if(!$this->checkCredentials($credentials))
            return null;

        $query = $this->newModelQuery(new UserEmailAlias());

        foreach ($credentials as $key => $value) {  //recorremos el array de credenciales por si la condición de login es compuesta. Ej. active=1
            if (str_contains($key, 'password')) //ignoramos password. Se comprueba después en EloquentUserProvider->validateCredentials()
                continue;

            $query->where($key, $value);
        }

        if(!$email = $query->first())
            return null;

        return $email->user;    //retornamos modelo usuario asociado al email introducido
    }


    private function checkCredentials(array $credentials): bool
    {
        return !(empty($credentials)
            || (count($credentials) === 1 && str_contains($this->firstCredentialKey($credentials), 'password'))
            || !array_key_exists('email', $credentials)); //Este proveedor de login requiere email

    }
}
