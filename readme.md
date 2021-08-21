#Basic description

Soooo... This app can:
1-CRUD with users
2-registering and and login
3-uploading user files to individual user storages
4-logging errors


#Docker

Open terminal in docker: docker exec -it webpage-template_my-app_1 bash  


#I STOPPED HERE:
All is working.
No tables and user in the db at the beginning, I need to solve the migration problem too...
Middleware in route.php is commented out. It should stay that way, untill I don't solve the migration issue.
Migration issue: I must have a users table created during the docker-compose up process, so the
new user could register himself.
A strange version of myLogs.txt is appearing in the public folder.