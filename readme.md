
# App description

The aim with this app was to create a modern, fully functional MVC php webpage, but only with the use of
vanilla php code and composer packages (so no framework was allowed.)

Soooo... This app can:
1-CRUD with users
2-registering and and login with validation
3-uploading user files to individual user storages
4-logging errors with exceptions
5-env variables are in .env file like in Laravel
6-works thorugh docker too
7-has MVC system for all requests
8-docker-compose with xdebug full set
9-works with api requests too


# Run the app

## Run this app through docker (currently this is only a secondary option)
 
 ### in terminal 
 - run `docker-compose build`
 - run `docker-compose up`
 - run `docker exec -it webpage-template_my-app_1 bash`
 
 ### in docker bash
 - run `composer install`
 - run `composer migrate`
 
 ### in browser
 - go to `localhost:8088`

### Reminder
Open terminal in docker: docker exec -it webpage-template_my-app_1 bash

Note: although the docker is fully functional, the xdebug execution is slow, because I have Windows on my laptop. Because of this, the primary set up for this app will be to work without docker. However, 
if there is a need, the app can be converted back to be used through docker.


## Run this app with PHP server for the first time (this is the default, primary option)
- start your xampp with apache and sql
- connect the app to your database. Use the .env file for sensitive database credentials
- in the terminal, run 'composer migrate'. This will create a users table in the db, 
necesary for user login and registration.
- In webpage-template/public dir, with cli, type 'php -S localhost:8889'
- Then just go to http://localhost:8889



# Features

## API requests and respone regarding user CRUD operations.
This app has a users table in db, where it stores the user data. We can send an API request,
for example with a Postman, to do CRUD operations over the user data. 
(show all users, show one user, edit user, delete user, etc. ...)
Hint: turn on Apache and
MySQL in XAMPP, before you send a request. :)
You can find the Postman collection in this file: 
'Postman collection for all user API requests.json'

## Registration and login with validation
This app has a hand-made vanilla registering and login system. The app 'remembers' the logged in
user with the help of the $_SESSION superglobal. We store here the user id, username, and the users 
login status.
Both for registering and for login there is a fairly complex validation process, with error 
displaying.
The navbar displays always, if the user is logged in or not. If the user is logged in, then a 
'Hi, ...' is displayed in navbar.

## Error logging
The app uses a singleton class for Logging. All exceptions in the app automatically do error logging.


## Exceptions


## Views
Every view has a header, footer and a navbar. These are reusable components. Views are here: 
resources\views.

## Upload and download
We can upload .jpg or .png images to this app. And .csv files.

### Image uploading
The image will be stored separatelly for every user. Every
uploading user will have a personel dir in the storage\upload dir. This personal dir will be named
after the users email address.

### .csv file uploading
When a .csv file is uploaded, the same process will happen as with the images. But, here we will 
have an additional process. This is the task that the app must do:

### .csv task description

The task is to run some calculations and display results based on data from an uploaded CSV file. 
The source data is an imaginary expenses report and the goal of the programme is to display total cost per expense category. Here is how the .csv file should look:

Hotel,10,2
Hotel,70,3
Fuel,1.21,24
Food,31,6
Fuel,1.18,10

So, above we have the uploaded data, which we have to calculate. The correct, final, calculated 
report should look like this:

Category,Cost
Hotel,230
Fuel,40.84
Food,186

Once the summary data has been calculated and displayed, it should be possible to generate and download a report CSV file.


### .csv processing

### .csv downloading

