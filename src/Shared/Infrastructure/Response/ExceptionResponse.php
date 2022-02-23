<?php


namespace Src\Shared\Infrastructure\Response;

use Src\Shared\Domain\Exceptions\DomainBaseException;
use Throwable;

class ExceptionResponse extends BaseResponse
{
    private $exception;

    public function __construct(string $message, Throwable $exception, int $status = 500)
    {
        $this->exception = $exception;

        if($this->isDomainException()){
            $status = $this->exception->getGeneratedStatus();
        }

        parent::__construct($message, $status);
    }

    /**
     * Formatea el objeto en formato array
     * @return array
     */
    public function toArray() : array
    {
        $message = $this->message;
        $status = $this->status;

        if($this->isDomainException()) {
            // Excepciones de dominio
            $trace = $this->exception->getExceptionTraceAsString();
            $errors = $this->exception->getExceptionMessage();
        } else {
            // Para Excepciones y Errors de PHP puro. Clase padre: Exception o Error
            $trace = $this->exception->getTraceAsString();
            $errors = $this->exception->getMessage();
        }

        if (config('app.env') != 'production') {   //Si no estamos en producción, imprimimos mas detalles de la excepcion
            return compact('message', 'errors', 'trace', 'status');
        }

        return compact('message', 'errors', 'status');
    }

    private function isDomainException(): bool
    {
        return is_subclass_of($this->exception, DomainBaseException::class, false);
    }
}
