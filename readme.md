## Install

 - install Docker
 
 #### in terminal 
 - run `docker-compose build`
 - run `docker-compose up`
 - run `docker exec -it my-app bash`
 
 #### in docker bash
 - run `composer install`
 - run `composer createdb`
 
 #### in browser
 - goto `localhost:8088`



# Basic description

Soooo... This app can:
1-CRUD with users
2-registering and and login
3-uploading user files to individual user storages
4-logging errors
5-env variables are hidden
6-works thorugh docker
7-has MVC system


# Docker

Open terminal in docker: docker exec -it webpage-template_my-app_1 bash  


# I STOPPED HERE:
register forms are repeating themselves. We need dry code.
The server time is wrong, it shows two hours earlier time.
The xdebug is not working currently with the docker???????