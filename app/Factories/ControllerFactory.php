<?php

declare(strict_types=1);

namespace App\Factories;

use App\Controllers\AuthControllers\LoginController;
use App\Controllers\AuthControllers\RegisterController;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\Validators\LoginValidator;
use App\Validators\RegisterValidator;

class ControllerFactory
{
    public static function loginController(): LoginController
    {
        return new LoginController(
            self::loginService()
        );
    }

    private static function loginService(): LoginService
    {
        return new LoginService(
            self::loginValidator()
        );
    }

    private static function loginValidator(): LoginValidator
    {
        return new LoginValidator();
    }

    public static function registerController(): RegisterController
    {
        return new RegisterController(
            self::registerService()
        );
    }

    private static function registerService(): RegisterService
    {
        return new RegisterService(
            self::registerValidator()
        );
    }

    private static function registerValidator(): RegisterValidator
    {
        return new RegisterValidator();
    }
}
