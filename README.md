# Project8Oc

## Project

It's a TodoList I get from this Github [lien]. For my formation, I needed to add some feature and test the site. (So if something missing, that's normal)
Some feature I added : 

- Now, every task is related to a User. There is 2 types of user : Admin and of course User. 
- Admin can delete own task or task with no User. User can only delete own task.
- There is a page for task and finished task
- Only Admin can create a new User

With all of this, there is some security on the site. If a member is not login, he can't do anything. 

## Install

You have to be carefull if you want to install this project because :

I used WAMPServer for the database, you can find it here : [lien]. If you have some problems with WampServer, don't worry, there are a lot of tutorials on internet. 
You will find everything you need. Or you can also use the documentation.

Then you need Symfony 4.4, if you need it : [lien]. You can download from this page and this is also the documentation. 
Symfony have a big documentation. If you don't know Symfony, everything is explain here. Most of the time, you just need this documentation.

## Install database

You need the database. For this, you need some library if they don't worked correctly (it's write at the end).

First, you need to be carefull about the name of the database, if you want to change , you can change it in .env and in this file, 
you can also change your database type, I'm using mysql but you can change to PostgreSQL or something else. 
Then you can open a terminal, go to your project with the command "cd", when you're in, use : php bin/console doctrine:database:create. That will create the database.

Then : php bin/console make:migration

and : php bin/console doctrine:migrations:migrate

And you have your database.

If you want some test, use this command, I write a file with some test inside : php bin/console doctrine:fixtures:load.

## Install website

If you install it in local, juste start symfony and test it.

## Test 

So, basically, there is 2 folders to check : First one : resultTest/ -> This is the coverage test code (for now 81% I think is tested) do with xDebug. It's just an HTML site
and you can check what is tested. 

And the other folder is tests/ -> here you can see all the test I have create. Because it's Symfony 4.4, I have some weird code. For example, the User test. I need it to 
create/delete/edit tasks and users

launch test with the coverage -> php -d xdebug.mode=coverage ./vendor/bin/phpunit --coverage-html resultTest/

## Library

## CodeClimate