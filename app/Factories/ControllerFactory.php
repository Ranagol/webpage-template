<?php

declare(strict_types=1);

namespace App\Factories;

use App\Controllers\AuthControllers\LoginController;
use App\Controllers\AuthControllers\RegisterController;
use App\Controllers\HeroController;
use App\Controllers\UploadDownloadCsv\UploadController;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\Validators\LoginValidator;
use App\Validators\RegisterValidator;
use Domain\HeroesAndMonsters\Services\HeroService;
use Domain\Report\Service\UploadService;

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

    public static function heroController(): HeroController
    {
        return new HeroController(self::heroService());
    }

    private static function heroService(): HeroService
    {
        return new HeroService();
    }

    public static function uploadController(): UploadController
    {
        return new UploadController(self::uploadService());
    }

    private static function uploadService(): UploadService
    {
        return new UploadService();
    }
}
