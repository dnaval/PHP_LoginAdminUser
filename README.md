/* 
 * Company: DNAVAL
 * Author: Daniel Naval
 * Application: Login Admin Users
 */

/*****  Description  *****/
PHP application with authentication and access to manage the users:
- Edit users information
- Add New users iformation
- Delete users
- Reset users password by forcing user to update their password
This sample can be used to manage any type of object (Student, Employee, Book in a Library, etc...)

/*****  Database Config  *****/
1- Create your MySQL database and then import the dnaval.sql file.

/*****  Application Config  *****/
1- Update the file zen-config-sample.php with your database credentials and place it outside of the root directory.
2- Rename the zen-config-sample.php to zen-cionfig.php
3- Update the location of the zen-config.php file ("require_once 'C:\wamp64\config\zen-config.php';") in models/DBController.php file 

/*****  Web Technologies and version  *****/
-- MySQL version: 5.7.31  (DATABASE)
-- PHP Version: 7.4.9     (POGRAMMING LANGUAGE)
-- Bootsrap version: 5    (HTML / CSS)