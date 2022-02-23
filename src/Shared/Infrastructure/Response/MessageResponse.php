<?php


namespace Src\Shared\Infrastructure\Response;

class MessageResponse extends BaseResponse
{
    public function __construct(string $message, int $status = 200)
    {
        parent::__construct($message, $status);
    }
}