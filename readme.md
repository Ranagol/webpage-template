
# 1. App description

The aim with this app was to create an MVC php webpage, but only with the use of vanilla php code and composer packages (so no framework was allowed).

Used technologies: PHP, bootstrap, Composer, Docker.

Soooo... This has the next features:

- A simple php web app, without framework
- Connects to a mysql db 
- registering and and login with credentials validation. App uses middleware.
- has MVC architecture
- For frontend displaying, we use Blade. As in Laravel.
- composer is used for loading classes and for running scripts (migration and seeding) 
- CRUD (create, read, update, delete) features on user objects through webpage
- CRUD (create, read, update, delete) features on user objects the apps API endpoint
- uploading user photos to individual user storages
- uploading specific .csv files with some costs. The app will process the uploaded .csv file, calculate
the sums of costs, and then it will create a downloadable .csv file report with the end result.
- send API request to https://dummyapi.io/, and display the received response
- logging errors with exceptions
- env variables are in .env file like in Laravel
- works through Docker too, and from local Xampp + MySQL database too
- uses xdebug for debugging (fully set, works when app runs through Docker)

All these features will be explained in details, below.


# 2. Run the app

## 2.1 Run this app through Docker 
### First things
- Create a .env file. Use the ./.env.example file as an example.
 
 ### in terminal
 (type these things in the root dir)
 - run `docker-compose build`
 - run `docker-compose up`
 - run `docker-compose exec -it php-container bash`
 
 ### in docker bash (not in the code editor terminal!!!)
 - run `composer install`
 - run `composer migrate` (this will run migrations)
 - run `composer seed` (this will run the seeders)
 
 ### in browser
 - go to `localhost:8088`

### Reminder:
Open terminal in docker: docker exec -it webpage-template_my-app_1 bash

If you want to connect your DBeaver to the Docker database container, connect like this:
- Server Host: localhost
- Database: webpage-template
- Username: your username defined in your .env
- Password: your password defined in your .env
- Port: 13306   <---- don't forget this!!

### xdebug
Xdebug is set to work. It works when the app runs through Docker, it will not work for your local
Xammp + MySQL enviroment.


## 2.2 Run this app with PHP server for the first time
- start your xampp and sql (apache is not needed)
- connect the app to your database. Use the .env file for sensitive database credentials. Of course, this db must be created first.
- in the terminal, run 'composer migrate'. This will create a users table in the db, necesary for user login and registration.
- Go to webpage-template/public dir. With terminal. Type 'php -S localhost:8889'
- Then just go to http://localhost:8889



# 3. Features

## 3.1 Registration and login with validation

This app has a hand-made vanilla registering and login system. The app 'remembers' the logged in user with the help of the $_SESSION superglobal. We store here the user id, username, and the users 
login status.
Both for registering and for login there is a fairly complex validation process, with error displaying.
The navbar displays always, if the user is logged in or not. If the user is logged in, then a 'Hi, ...' is displayed in navbar.

- Login: http://localhost:8889/login
- Register: http://localhost:8889/register

## 3.2 Views

Every view has a header, footer and a navbar. These are reusable components. Views are here: 
resources\views.
The navbar displays always, if the user is logged in or not. If the user is logged in, then a 'Hi, ...' is displayed in navbar.
Views are done according to MVC architecture.

## 3.3 User CRUD through the webpage

We can do basic create, read, update and delete users.
Here: http://localhost:8889/users

## 3.3 User CRUD through API requests

This app has a users table in db, where it stores the user data. We can send an API request, for example with a Postman, to do CRUD operations over the user data. (show all users, show one user, edit user, delete user, etc. ...)
Hint: turn on MySQL in XAMPP, before you send a request, of you use this app without Docker.
You could use Postman to test this feature.
You can find the Postman collection in this file: ./Postman collection for all user API requests.json. 
This is the root dir.
Just upload this to your Postman, and you will be quickly able to send API requests and get responses.


Examples for the API request urls:
- GET     /server/users           list all users
- GET     /server/users/{id}      show this user
- POST    /server/users           create/save new user

Note: the files necesary to do request/response are here: ./system.




## 3.4 Upload and download

We can upload .jpg or .png images to this app. And .csv files.
The upload happens here: http://localhost:8889/upload


### 3.4.1 Image uploading

The image will be stored separatelly for every user. Every uploading user will have a personal dir in the storage\upload dir. This personal dir will be named after the users email address. If the user uploads multiple documents, naturally all these documents will be stored only in one place: in his directory.
Example, if a user with email address tri@gmail.com uploads a .png picture, the picture will be found here: storage\upload\tri@gmail.com\Honorverse map.png

### 3.4.2 .csv file uploading

#### 3.4.2.1 .csv task description


The task is to run some calculations and display results based on data from an uploaded CSV file. 
The source data is an imaginary expenses report and the goal of the programme is to display total cost per expense category. Here is how the .csv file should look (The first is the cost name, example:
Hotel. The second is the cost, example 10 eur. The third is the quantity, example:2.):

- Hotel,10,2
- Hotel,70,3
- Fuel,1.21,24
- Food,31,6
- Fuel,1.18,10

So, above we have the uploaded data, which we have to calculate. The correct, final, calculated 
report should look like this:

Category,Cost
- Hotel,230       
- Fuel,40.84 
- Food,186        

Once the summary data has been calculated and displayed in the app, it should be possible to generate and download a report CSV file.

Use this file: ./csvFile.csv
When a .csv file is uploaded, the same process will happen as with the images. But, here we will 
have an additional process. This is the task that the app must do:


## 3.5 Send API request to another webpage

With the use of Guzzle, this app can send API requests to https://dummyapi.io/, and it is able to
display the received response.
This feature is here: http://localhost:8889/guzzle


## 3.6 Error logging and exceptions

The app uses a singleton class for Logging.
All exceptions used in this app should inherit from app\exceptions\BaseException.php
This will ensure that when an BaseException is thrown, it will be logged.
The logs are recorded here: 
storage\logs\myLogs.txt
How to check this feature? Just copy these two lines into router\routes.php file. 

`use App\Exceptions\BaseException;`

`throw new BaseException('Just testing if this exception will be written in the log file.');`

Now just refresh the webpage, the routes.php file will throw a BaseException, and this will be 
logged.


## 3.7 Eloquent

The app uses Eloquent to work with db, similar like Laravel.
All future models should inherit Illuminate\Database\Eloquent\Model; like it was done in 
app\models\User.php. After this setup we can use models like in Laravel.
illuminate/database composer package is used for this feature.
The users and the seeders table is created by migrations, and seeded by a seeder.

## 3.8 Routes


For routing I used the bramus/router composer package. Everything regarding routes is in the
./router dir. The ./routes/routes.php contains the router setup, this is the central place for the
routes.


MIDDLEWARE: Only the login, register, logout views are accessible for a not-logged-in user. The app is checking
in the $_SUPERGLOBAL, if the user is logged in.


## 3.9 Student - Quantox task
This code challenge was from Quantox company. The task was:
if an API request is sent to this app's url, for example /webpage-template/students/1,
then the response must had the details of this student, with calculated averages and passed/not passed
final decision. This is just a very simple description of the task, for more details see the task.

## 4.0 Train - Antiloop task
This was a code challenge from Antiloop company. There are two train stations, A and B. This is an
example train schedule for one day:
From A to B
09:00 12:00
10:00 13:00
11:00 12:30
From B to A 
12:02 15:00
09:00 10:30 
The needs to calculate how many trains need to be at A and B station at the beginning of the day.
This is just a quick description,, for more details see the official task.
To handle this task, just open app\console\TrainCommand.php, there you will have all the instructions.

## 4.1 PHP DebugBar
This app uses PHP Debugbar.

