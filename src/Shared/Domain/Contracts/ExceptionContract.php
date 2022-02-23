<?php

namespace Src\Shared\Domain\Contracts;

interface ExceptionContract
{
    public function getExceptionMessage();
    public function getGeneratedStatus();
}
