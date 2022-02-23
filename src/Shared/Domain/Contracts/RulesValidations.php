<?php


namespace Src\Shared\Domain\Contracts;


interface RulesValidations
{
    public function rules(array $data = null): array;
}
