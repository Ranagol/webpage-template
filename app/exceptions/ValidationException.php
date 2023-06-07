<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

/**
 * This is triggered when there is a validation error - exception. 
 * Example: password is shorter than 3 characters.
 */
class ValidationException extends BaseException
{
}
