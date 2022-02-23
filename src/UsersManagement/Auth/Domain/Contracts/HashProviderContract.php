<?php

namespace Src\UsersManagement\Auth\Domain\Contracts;


interface HashProviderContract
{
    public function hash(string $text): string;
}
