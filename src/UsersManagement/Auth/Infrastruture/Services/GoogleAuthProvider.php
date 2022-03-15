<?php


namespace Src\UsersManagement\Auth\Infrastruture\Services;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;
use Src\UsersManagement\Auth\Domain\Contracts\SocialAuthProviderContract;
use Src\UsersManagement\User\Application\GoogleUserFinder;
use Src\UsersManagement\User\Domain\Exceptions\GoogleUserNotFound;
use Src\UsersManagement\User\Domain\UserRepositoryContract;


/**
 * Proveedor que implementa el inicio de sesión con Google utilizando el paquete Socialite de Laravel
 *
 * Class GoogleAuthProvider
 * @package Src\UsersManagement\Auth\Infrastruture\Services
 */
class GoogleAuthProvider implements SocialAuthProviderContract
{

    private const DRIVER = "google";
    private Provider $googleAuth;
    private AuthProviderContract $localAuthProvider;
    private GoogleUserFinder $googleUserFinder;

    /**
     * GoogleAuthProvider constructor.
     * @param AuthProviderContract $authProvider
     * @param UserRepositoryContract $repository
     */
    public function __construct(AuthProviderContract $authProvider, UserRepositoryContract $repository)
    {
        $socialiteAuth = new Socialite();
        $this->localAuthProvider = $authProvider;
        $this->googleAuth = $socialiteAuth::driver(self::DRIVER);   //Inicializa Socialite con el driver de Google

        $this->googleUserFinder = new GoogleUserFinder($repository);
    }


    /**
     * Redirecciona hacia la pantalla de autenticación de Google
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
     */
    public function redirectToProvider(): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        return $this->googleAuth->redirect();
    }


    /**
     * Loguea al usuario de Google en el sistema. En caso de no exister realiza el registro
     * @return Application|RedirectResponse|Redirector
     */
    public function login(): Redirector|RedirectResponse|Application
    {
        $google_user = $this->user();

        try {
            //Si ya existe el usuario lo logueamos
            $user = $this->googleUserFinder->execute($google_user->getId());
            $this->localAuthProvider->login($user);

        }catch (GoogleUserNotFound $e) {
            //Registramos el usuario si no existe
            $this->localAuthProvider->register([
                'name'      => $google_user->getName(),
                'avatar'    => $google_user->getAvatar(),
                'google_id' => $google_user->getId(),
                'password'  => Hash::make('xxxx'),    //TODO: Implementar forzado de cambio de contraseña en el primer login
                'emails'    => [["email" => $google_user->getEmail()]]
            ]);
        }

        return redirect('/dashboard');
    }

    /**
     * Devuelve una instancia de Usuario del paquete Socialite de Laravel con la información obtenida de Google
     * @return User
     */
    public function user(): User
    {
        return $this->googleAuth->user();
    }
}
