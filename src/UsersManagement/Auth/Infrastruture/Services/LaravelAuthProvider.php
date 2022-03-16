<?php


namespace Src\UsersManagement\Auth\Infrastruture\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User as EloquentUser;
use Illuminate\Validation\ValidationException;
use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;
use Src\UsersManagement\User\Application\UserCreator;
use Src\UsersManagement\User\Domain\Entities\User;
use Src\UsersManagement\User\Domain\UserRepositoryContract;

/**
 * Class LaravelAuthProvider
 * Adaptador de proveedor de autenticación que utiliza la autenticación de Laravel
 *
 * @method self guard()
 * @package Src\UsersManagement\Auth\Infrastruture\Services
 */
class LaravelAuthProvider implements AuthProviderContract
{

    private LaravelAuth $laravelAuth;
    private UserCreator $userCreator;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->laravelAuth = new LaravelAuth();
        $this->userCreator = new UserCreator($userRepository);
    }

    /**
     * @param array<string,string> $credentials
     * @throws ValidationException
     */
    public function attempt(array $credentials): bool
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
     * @return Authenticatable|null
     */
    public function user(): ?Authenticatable
    {
        return $this->laravelAuth::user();
    }

    /**s
     * Loguea al usuario de dominio pasado por parametro
     * @param User $domainUser
     */
    public function login(User $domainUser): void
    {
        $model = new EloquentUser();
        $eloquentUser = $model->where("uuid", $domainUser->id()->value())->first();
        $this->laravelAuth::login($eloquentUser);
    }


    /**
     * @param array<string,string> $data
     * @throws ValidationDomainException
     */
    public function register(array $data): void
    {
        $domainUser = $this->userCreator->execute($data);   //Creamos nuevo usuario
        $this->login($domainUser);  //Logueamos el usuario registrado
    }


    /**
     * Destruye la sesión actual
     * @return void
     */
    public function logout(): void
    {
        $this->laravelAuth->guard('web')->logout();
    }

}
