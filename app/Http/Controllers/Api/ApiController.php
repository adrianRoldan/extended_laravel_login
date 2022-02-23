<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Src\UsersManagement\User\Infrastructure\Controllers\GetMostUsedDomainsController;

class ApiController
{

    public function getMostUsedDomains(Request $request, GetMostUsedDomainsController $usedDomainsController)
    {
        $response = $usedDomainsController($request->max ?? null);
        return response()->json($response->toArray(), $response->getStatus());
    }
}
