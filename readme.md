
# App description

The aim with this app was to create a modern, fully functional MVC php webpage, but only with the use of
vanilla php and packages (so no framework was allowed.)

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
 
 #### in terminal 
 - run `docker-compose build`
 - run `docker-compose up`
 - run `docker exec -it webpage-template_my-app_1 bash`
 
 #### in docker bash
 - run `composer install`
 - run `composer migrate`
 
 #### in browser
 - go to `localhost:8088`

#### Reminder
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
Both for registering and for login there is a faily complex validation process, with error displaying.

## Logging
The app uses a singleton class for Logging.

## Error handling, exceptions and error logging




