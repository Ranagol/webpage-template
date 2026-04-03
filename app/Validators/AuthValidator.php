<?php

declare(strict_types=1);

namespace App\Validators;

use App\Exceptions\ValidationException;

/**
 * This class contains functions that are used by LoginValidator
 * and RegisterValidator too. That is why the AuthValidator is parent of the LoginValidator and the
 * RegisterValidator.
 *
 * 1 - all email, password, username validation errors are collected in $errors
 * 2 - we count the number of these errors in the $errors. If there are errors in $errors, then
 * this class throws an exception.
 */
abstract class AuthValidator
{
    /**
     * Since a form is sending multiple input fields like email, password, username...
     * We must collect in one place all the errors regarding these multiple input fields.
     * This is the place where this collection is happening. For registration and for login too.
     *
     * @var string[]
     */
    protected $errors = [];

    /**
     * After the end of the validation process, this function checks if there are
     * validation errors. If so, then it throws an exception.
     * This exception will be catched in a try/catch block in RegisterController.
     *
     * @throws ValidationException
     */
    protected function checkForValidationErrors(): bool
    {
        if (count($this->errors) > 0) {
            $msg = json_encode($this->errors);
            if (false === $msg) {
                $msg = 'Validation error.';
            }
            throw new ValidationException((string) $msg, 422);
        }

        return true;
    }

    /**
     * Input field validation function.
     * Any new validation rules should be added with a new elseif at the end.
     * Password and email validation are the same for login and register. So, these two features
     * are in the parent AuthValidator, and not in the RegisterValidator or LoginValidator.
     */
    protected function validateEmail(string $email): void
    {
        $emailError = null;
        $email = trim($email);

        if (empty($email)) {
            $emailError = 'Please enter an email.';
        } elseif (strlen($email) > 254) {
            $emailError = 'Email is too long.';
        } elseif (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = 'Please enter a valid email address.';
        }

        if (null !== $emailError) {
            $this->errors['emailError'] = $emailError;
        }
    }

    /**
     * Input field validation function.
     * Any new validation rules should be added with a new elseif at the end.
     *
     * Password and email validation are the same for login and register. So, these two features
     * are in the parent AuthValidator, and not in the RegisterValidator or LoginValidator.
     */
    protected function validatePassword(string $password): void
    {
        $passwordError = null;

        if (empty($password)) {
            $passwordError = 'Please enter a password.';
        } elseif (strlen($password) <= 2) {
            $passwordError = 'Password must be longer than 2 characters.';
        }

        if (null !== $passwordError) {
            $this->errors['passwordError'] = $passwordError;
        }
    }
}
