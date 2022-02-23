<?php


namespace Src\UsersManagement\Auth\Infrastruture\Services;

use Illuminate\Support\Facades\Hash;
use Src\UsersManagement\Auth\Domain\Contracts\HashProviderContract;


/**
 * Adaptador que implementa el proveedor de generación de hashes de Laravel
 *
 * Class LaravelHashProvider
 * @package Src\UsersManagement\Auth\Infrastruture\Services
 */
class LaravelHashProvider implements HashProviderContract
{

    /**
     * @param string $text
     * @return string
     */
    public function hash(string $text): string
    {
        return Hash::make($text);
    }
}
