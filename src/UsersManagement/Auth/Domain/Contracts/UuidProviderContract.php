<?php

namespace Src\UsersManagement\Auth\Domain\Contracts;


interface UuidProviderContract
{
    public function generate(): string;
}
