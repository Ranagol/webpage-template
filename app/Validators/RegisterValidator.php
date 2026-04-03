<?php

declare(strict_types=1);

namespace App\Validators;

/**
 * Validates email, password, firstname...
 *
 * Inherits from AuthValidator parent the exception throwing ability.
 *
 * Password and email validation are the same for login and register.
 * So, these two features* are in the parent AuthValidator, and not in the RegisterValidator or
 * LoginValidator.
 */
class RegisterValidator extends AuthValidator
{
    /**
     * Validates register data.
     */
    public function validate(
        string $email,
        string $password,
        string $username,
        string $firstname,
        string $lastname,
    ): void {
        $this->validateUsername($username);
        $this->validateFirstname($firstname);
        $this->validateLastname($lastname);
        $this->validateEmail($email);
        $this->validatePassword($password);
        $this->validatePasswordStrength($password);

        /*
         * Here we check if there are validation errors. If so, an exception is thrown.
         */
        $this->checkForValidationErrors();
    }

    /**
     * Input field validation function.
     * Any new validation rules should be added with a new elseif at the end.
     *
     * @param string $username
     */
    private function validateUsername($username): void
    {
        $usernameError = null;

        if (empty($username)) {
            $usernameError = 'Please enter a username.';
        } elseif (strlen($username) <= 2) {
            $usernameError = 'Username must be longer than 2 characters.';
        }

        if (null !== $usernameError) {
            $this->errors['usernameError'] = $usernameError;
        }
    }

    /**
     * Input field validation function.
     * Any new validation rules should be added with a new elseif at the end.
     *
     * @param string $firstname
     */
    private function validateFirstname($firstname): void
    {
        $firstnameError = null;

        if (empty($firstname)) {
            $firstnameError = 'Please enter a firstname.';
        } elseif (strlen($firstname) <= 2) {
            $firstnameError = 'Firstname must be longer than 2 characters.';
        }

        if (null !== $firstnameError) {
            $this->errors['firstnameError'] = $firstnameError;
        }
    }

    /**
     * Input field validation function.
     * Any new validation rules should be added with a new elseif at the end.
     *
     * @param string $lastname
     */
    private function validateLastname($lastname): void
    {
        $lastNameError = null;

        if (empty($lastname)) {
            $lastNameError = 'Please enter a lastname.';
        } elseif (strlen($lastname) <= 2) {
            $lastNameError = 'Lastname must be longer than 2 characters.';
        }

        if (null !== $lastNameError) {
            $this->errors['lastNameError'] = $lastNameError;
        }
    }

    /**
     * Registration needs a stronger password policy than login.
     */
    private function validatePasswordStrength(string $password): void
    {
        if (isset($this->errors['passwordError'])) {
            return;
        }

        $passwordError = null;

        if (strlen($password) < 8) {
            $passwordError = 'Password must be at least 8 characters long.';
        }

        if (null !== $passwordError) {
            $this->errors['passwordError'] = $passwordError;
        }
    }
}
