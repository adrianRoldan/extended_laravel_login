<?php


namespace Src\Shared\Domain\Contracts;


interface RulesValidations
{
    /**
     * @param array<string,string>|null $data
     * @return array<string,string>
     */
    public function rules(array $data = null): array;
}
