<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * This is triggered when there is a validation error - exception.
 * Example: password is shorter than 3 characters.
 */
class ValidationException extends BaseException
{
    /**
     * @var array<string, string>
     */
    private array $errors;

    /**
     * @param array<string, string> $errors
     */
    public function __construct(array $errors, int $code = 422)
    {
        parent::__construct('Validation error.', $code);
        $this->errors = $errors;
    }

    /**
     * @return array<string, string>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
