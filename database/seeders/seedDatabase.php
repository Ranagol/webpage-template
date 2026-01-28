<?php

/**
 * When 'composer seed' will by typed into the terminal
 * we will directly activate this php file only. That means that the dotennv package (what we need 
 * to get the env variables from the .env file) and the Eloquent package (that we need for the 
 * migration) are not booted, since we only trigger this php file. That is why we need to require the
 * autoloader and the bootstrap.php. Triggering the bootstrap will automatically trigger the Eloquent
 * and the dotenv.
 */
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../bootstrap/bootstrap.php';

use App\Models\User;
use App\Models\Student;

/**
 * USER SEEDER
 * 
 * Seed the users table. For simplicity, we use the email for all the user fields. The data is pulled
 * from the .env file.
 */
User::create([
    'username' => $_ENV['USER_EMAIL_1'],
    'firstname' => $_ENV['USER_EMAIL_1'],
    'lastname' => $_ENV['USER_EMAIL_1'],
    'email' => $_ENV['USER_EMAIL_1'],
    'password' => password_hash($_ENV['USER_EMAIL_1'], PASSWORD_DEFAULT)
]);

User::create([
    'username' => $_ENV['USER_EMAIL_2'],
    'firstname' => $_ENV['USER_EMAIL_2'],
    'lastname' => $_ENV['USER_EMAIL_2'],
    'email' => $_ENV['USER_EMAIL_2'],
    'password' => password_hash($_ENV['USER_EMAIL_2'], PASSWORD_DEFAULT)
]);

echo 'Users table seeded!' . PHP_EOL;


/**
 * Student data
 */
$students = [
    [
        'name' => 'John Doe',
        'board' => 'CSM',
        'grades' => json_encode([8, 9, 10])
    ],
    [
        'name' => 'Jane Doe',
        'board' => 'CSM',
        'grades' => json_encode([6])
    ],
    [
        'name' => 'John Smith',
        'board' => 'CSMB',
        'grades' => json_encode([6])
    ],
    [
        'name' => 'Jane Smith',
        'board' => 'CSMB',
        'grades' => json_encode([5, 6, 7])
    ],
    [
        'name' => 'John Johnson',
        'board' => 'CSMB',
        'grades' => json_encode([8, 9, 10])
    ],
    [
        'name' => 'Jane Johnson',
        'board' => 'CSMB',
        'grades' => json_encode([5, 10, 10])
    ],
   
];

/**
 * STUDENT SEEDER
 * 
 * Seed the students table. 
 */
foreach ($students as $student) {
    Student::create($student);
}

echo 'Students table seeded!' . PHP_EOL;



