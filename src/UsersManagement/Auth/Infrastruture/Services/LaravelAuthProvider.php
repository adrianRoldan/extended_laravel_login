<?php


namespace Src\UsersManagement\Auth\Infrastruture\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User as EloquentUser;
use Illuminate\Validation\ValidationException;
use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;
use Src\UsersManagement\User\Application\UserCreator;
use Src\UsersManagement\User\Application\UserFinder;
use Src\UsersManagement\User\Domain\Entities\User;
use Src\UsersManagement\User\Domain\UserRepositoryContract;

/**
 * Class LaravelAuthProvider
 * Adaptador de proveedor de autenticación que utiliza la autenticación de Laravel
 *
 * @package Src\UsersManagement\Auth\Infrastruture\Services
 */
class LaravelAuthProvider implements AuthProviderContract
{

    private Auth $laravelAuth;
    private UserCreator $userCreator;
    private UserFinder $userFinder;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->laravelAuth = new Auth();
        $this->userCreator = new UserCreator($userRepository);
        $this->userFinder = new UserFinder($userRepository);
    }

    /**
     * @param array $credentials
     * @throws ValidationException
     */
    public function attempt(array $credentials)
    {
        if (!$this->laravelAuth::attempt($credentials)) {

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        return true;
    }

    /**
     * Devuelve el usuario logueado
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return $this->laravelAuth::user();
    }

    /**
     * Loguea al usuario de dominio pasado por parametro
     * @param User $domainUser
     */
    public function login(User $domainUser)
    {
        $eloquentUser = EloquentUser::where("uuid", $domainUser->id()->value())->first();
        $this->laravelAuth::login($eloquentUser);
    }


    /**
     * @param array $data
     * @throws ValidationDomainException
     */
    public function register(array $data)
    {
        $domainUser = $this->userCreator->execute($data);   //Creamos nuevo usuario
        $this->login($domainUser);  //Logueamos el usuario registrado
    }


    /**
     * Destruye la sesión actual
     */
    public function logout()
    {
        $this->laravelAuth::guard('web')->logout();
    }

}
