<?php


namespace Src\Shared\Infrastructure\Services;

use Ramsey\Uuid\Uuid;
use Src\UsersManagement\Auth\Domain\Contracts\UuidProviderContract;


/**
 * Adaptador que implementa el proveedor de generación uuid Ramsey
 *
 * Class RamseyUuidProvider
 * @package Src\Shared\Auth\Infrastructure\Services
 */
class RamseyUuidProvider implements UuidProviderContract
{
    /**
     * @return string
     */
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
