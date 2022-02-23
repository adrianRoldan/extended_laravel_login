<?php

namespace App\Http\Controllers;


use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Src\UsersManagement\Auth\Infrastruture\Controllers\GoogleLoginController;
use Src\UsersManagement\Auth\Infrastruture\Controllers\LoginController;
use Src\UsersManagement\Auth\Infrastruture\Controllers\LogoutController;
use Src\UsersManagement\Auth\Infrastruture\Controllers\RegisterController;
use Throwable;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * @param LoginController $loginController
     * @return RedirectResponse
     * @throws Throwable
     */
    public function login(LoginController $loginController)
    {

        $credentials = request(['email', 'password']);

        $loginController($credentials);

        return redirect()->intended(RouteServiceProvider::HOME);
    }



    public function showRegister()
    {
        return view('auth.register');
    }



    public function register(Request $request, RegisterController $registerController)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user_email_aliases'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        try {

            $registerController($request->all());

        } catch (Throwable $exception) {

            Log::error($exception);
            return redirect()->route("register")
                ->withErrors(['error' => "Ha habido un problema durante el registro"]);
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function logout(LogoutController $logoutController)
    {
        $logoutController();

        return redirect(RouteServiceProvider::HOME);
    }


    /**
     * @param GoogleLoginController $googleLoginController
     * @return mixed
     */
    public function redirectToGoogle(GoogleLoginController $googleLoginController)
    {
        return $googleLoginController->redirect();
    }


    /**
     * @param GoogleLoginController $googleLoginController
     * @return mixed
     */
    public function handleGoogleLoginCallback(GoogleLoginController $googleLoginController)
    {
        try{
            return $googleLoginController->login();

        }catch(Throwable $exception)
        {
            Log::error($exception);
            return redirect()->route("login")
                ->withErrors(['error' => "No se ha podido iniciar sesión con Google"]);
        }
    }
}
