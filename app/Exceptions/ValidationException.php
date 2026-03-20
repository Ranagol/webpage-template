<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * This is triggered when there is a validation error - exception.
 * Example: password is shorter than 3 characters.
 */
class ValidationException extends BaseException
{
}
