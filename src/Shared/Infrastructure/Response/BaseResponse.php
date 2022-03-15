<?php

namespace Src\Shared\Infrastructure\Response;

class BaseResponse
{
    protected string $message;
    protected int $status;

    public function __construct(string $message, int $status = 200)
    {
        $this->message = $message;
        $this->status = $status;
    }


    public function getStatus(): int
    {
        return $this->status;
    }


    /**
     * Formatea el objeto en formato array
     * @return array<string,string|int>
     */
    public function toArray() : array
    {
        return [
            "message"  => $this->message,
            "status"   => $this->status
        ];
    }
}
