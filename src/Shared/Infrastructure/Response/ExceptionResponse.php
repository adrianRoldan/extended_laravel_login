<?php


namespace Src\Shared\Infrastructure\Response;

use Src\Shared\Domain\Exceptions\DomainBaseException;
use Throwable;

class ExceptionResponse extends BaseResponse
{
    private Throwable $exception;

    public function __construct(string $message, Throwable $exception, int $status = 500)
    {
        $this->exception = $exception;

        parent::__construct($message, $status);
    }

    /**
     * Formatea el objeto en formato array
     * @method getExceptionTraceAsString()
     * @return array<string,string|int>
     */
    public function toArray(): array
    {
        $message = $this->message;
        $status = $this->status;

        $trace = $this->exception->getTraceAsString();
        $errors = $this->exception->getMessage();


        if (config('app.env') != 'production') {   //Si no estamos en producción, imprimimos mas detalles de la excepcion
            return compact('message', 'errors', 'trace', 'status');
        }

        return compact('message', 'errors', 'status');
    }
}
