<?php

namespace App\Http\Controllers\WebApi;


use Illuminate\Routing\Controller;
use Src\UsersManagement\User\Infrastructure\Controllers\DeleteUserController;
use Src\UsersManagement\User\Infrastructure\Controllers\GetUsersController;

class UserController extends Controller
{

    public function users(GetUsersController $getterController)
    {
        $response = $getterController();
        return response()->json($response->toArray(), $response->getStatus());
    }


    public function delete(string $id, DeleteUserController $deleteController)
    {
        $response = $deleteController($id);
        return response()->json($response->toArray(), $response->getStatus());
    }
}
