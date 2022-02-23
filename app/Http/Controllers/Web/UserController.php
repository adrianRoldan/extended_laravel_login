<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Routing\Controller;

class UserController extends Controller
{

    public function show(string $id)
    {
        // Generamos con Sanctum un nuevo token para la API externa (api.php) cada vez que entre a la ficha de usuario
        $user = User::where("uuid", $id)->firstOrFail();
        $token = $user->createToken("TokenAPIexterna")->plainTextToken;

        return view("web.user-form", compact('user', 'token'));
    }

    public function create()
    {
        return view("web.user-form");
    }
}
