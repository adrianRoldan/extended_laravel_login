<?php


namespace Src\Shared\Domain\Contracts;


interface EntityContract
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(): array;
}
