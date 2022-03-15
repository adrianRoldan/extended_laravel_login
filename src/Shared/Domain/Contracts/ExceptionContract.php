<?php

namespace Src\Shared\Domain\Contracts;

interface ExceptionContract
{
    public function getGeneratedStatus(): int;
}
