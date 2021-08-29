
# Basic description

The aim with this app was to create a modern, fully functional MVC php webpage, but only with the use of
vanilla php and packages (so no framework was allowed.)

Soooo... This app can:
1-CRUD with users
2-registering and and login
3-uploading user files to individual user storages
4-logging errors
5-env variables are hidden
6-works thorugh docker
7-has MVC system for all requests
8-docker-compose with xdebug full set
9-works with api requests

## Run this app thorugh docker
 
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

Note: although the docker is fully functional, the xdebug execution is slow, because I have Windows on my laptop.
Because of this, the primary set up for this app will be to work without docker. However, if there is a need, the
app can be converted back to be used thorugh docker.


## Run this app without docker (this is the primary, default option)
- start your mysql or xampp
- In webpage-template/public dir, with cli, type 'php -S localhost:8889'