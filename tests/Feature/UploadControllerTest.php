<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application;
use App\Controllers\UploadDownloadCsv\UploadController;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use PHPUnit\Framework\TestCase;

final class UploadControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Configure Eloquent to use in-memory SQLite and force it as default connection
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ], 'sqlite');
        // Also add as 'default' connection for legacy/default lookups
        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ], 'default');

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        // Set the default connection name to 'sqlite' globally
        Capsule::connection('sqlite');
        \Illuminate\Database\Eloquent\Model::setConnectionResolver($capsule->getDatabaseManager());
        \Illuminate\Database\Eloquent\Model::setEventDispatcher(new \Illuminate\Events\Dispatcher());
        \Illuminate\Database\Eloquent\Model::unguard();

        // If your User model or other models specify a $connection property, override it here
        if (class_exists('App\\Models\\User')) {
            \App\Models\User::resolveConnection('sqlite');
        }

        // Create users table
        Capsule::schema()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->timestamps();
        });

        // Seed user with ID 1
        Capsule::table('users')->insert([
            'id' => 1,
            'username' => 'testuser',
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'testuser@example.com',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function testLoadPage(): void
    {
        Application::bootstrap();
        $uploadController = new UploadController();
        ob_start();
        $uploadController->loadPage();
        $output = ob_get_clean();
        $this->assertStringContainsString('Challenge 2: File Upload & Processing', $output);
        $this->assertStringContainsString('csrf_token', $output);
    }

    public function testStoreCsvUpload(): void
    {
        Application::bootstrap();
        $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
        $_SESSION['csrf_token'] = 'valid_csrf_token';
        $_SESSION['id'] = 1;
        $tmpFile = tempnam(sys_get_temp_dir(), 'csv');
        file_put_contents($tmpFile, "category,price,amount\nHotel,10,2\nHotel,70,3\nFuel,1.21,24\nFood,31,6\nFuel,1.18,10");

        $uploadData = [
            'csrf_token' => 'valid_csrf_token',
            'file' => [
                'name' => 'test.csv',
                'type' => 'text/csv',
                'tmp_name' => $tmpFile,
                'error' => 0,
                'size' => filesize($tmpFile),
            ],
        ];

        $request = $this->createMock(\System\request\RequestInterface::class);
        $request->method('getAllRequestData')->willReturn($uploadData);
        $uploadController = new UploadController();
        $obLevel = ob_get_level();
        ob_start();
        try {
            $uploadController->store($request);
            $output = ob_get_clean();
        } finally {
            // Only close the buffer we opened
            while (ob_get_level() > $obLevel) {
                @ob_end_clean();
            }
        }
        @unlink($tmpFile);
        $this->assertStringContainsString('Calculated totals grouped by category from the uploaded expenses CSV.', $output);
    }
}
