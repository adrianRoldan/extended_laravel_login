<?php

namespace App\Http\Controllers\WebApi;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\UsersManagement\User\Infrastructure\Controllers\CreateUserEmailController;
use Src\UsersManagement\User\Infrastructure\Controllers\DeleteUserEmailController;
use Src\UsersManagement\User\Infrastructure\Controllers\GetUserEmailsController;
use Src\UsersManagement\User\Infrastructure\Controllers\UpdateUserEmailController;

class UserEmailController extends Controller
{

    /**
     * @param string $user_id
     * @param GetUserEmailsController $getterController
     * @return JsonResponse
     */
    public function emailsUser(string $user_id, GetUserEmailsController $getterController)
    {
        $response = $getterController($user_id);
        return response()->json($response->toArray(), $response->getStatus());
    }


    /**
     * @param Request $request
     * @param CreateUserEmailController $createController
     * @return JsonResponse
     */
    public function save(Request $request, CreateUserEmailController $createController)
    {
        $response = $createController($request->user_id, $request->emails);
        return response()->json($response->toArray(), $response->getStatus());
    }


    /**
     * @param string $email_id
     * @param DeleteUserEmailController $deletorController
     * @return JsonResponse
     */
    public function delete(string $email_id, DeleteUserEmailController $deletorController)
    {
        $response = $deletorController( (int) $email_id);
        return response()->json($response->toArray(), $response->getStatus());
    }


    /**
     * @param Request $request
     * @param UpdateUserEmailController $updatorController
     * @return JsonResponse
     */
    public function update(Request $request, UpdateUserEmailController $updatorController)
    {
        $response = $updatorController( (int) $request->email_id, $request->email);
        return response()->json($response->toArray(), $response->getStatus());
    }
}
