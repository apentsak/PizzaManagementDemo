<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use JetBrains\PhpStorm\Pure;

class FilterValidationException extends Exception
{
    private array $errors;

    #[Pure]
    public function __construct(array $errors, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function httpErrorCode(): int
    {
        return 422;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
