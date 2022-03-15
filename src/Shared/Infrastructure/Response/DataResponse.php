<?php

namespace Src\Shared\Infrastructure\Response;

class DataResponse extends BaseResponse
{
    private mixed $data;

    public function __construct(string $message, mixed $data, int $status = 200)
    {
        parent::__construct($message, $status);
        $this->data = $data;
    }

    /**
     * Formatea el objeto en formato array
     * @return array<string,mixed>
     */
    public function toArray() : array
    {
        return [
            "message"  => $this->message,
            "data"     => $this->data,
            "status"   => $this->status
        ];
    }
}
