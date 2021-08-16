# Login Admin Users

PHP application with authentication and access to manage the users

## Description

* Edit users information
* Add New users information
* Delete users
* Reset users password by forcing user to update their password

## Getting Started

### Dependencies

* Wampserver or LAMP server With the specification below.
* MySQL version: 5.7.31  (DATABASE)
* PHP Version: 7.4.9     (POGRAMMING LANGUAGE)
* Bootsrap version: 5    (HTML / CSS)
* Activate PDO_MySQL extension for PHP 7.4

### Installing

* Create your MySQL database and then import the dnaval.sql file.
* Update the file zen-config-sample.php with your database credentials and place it outside of the root directory.
* Rename the zen-config-sample.php to zen-cionfig.php
* Update the location of the zen-config.php file ("require_once 'C:\wamp64\config\zen-config.php';") in models/DBController.php file 

### Executing program

* Upload the project in a folder in your root directory
* Open the project via browser and login with admin@dnaval.com / admin

## Authors

Contributors names and contact info

Daniel Naval 
[@navald27](https://twitter.com/navald27)
