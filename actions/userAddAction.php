<?php
/* 
 * Company: DNAVAL
 * Author: Daniel Naval
 * Script: Add new user 
 */

session_start();

//DB connexion Class
require '../model/DBController.php';

//Set today's date
date_default_timezone_set('America/Nassau');
$today = date("Y-m-d H:i:s");

// Get the value from the form
$fname = $_POST['fname'];
$login = $_POST['login'];
$jtitle = $_POST['jtitle'];
$dept = $_POST['dept'];
$iddept = $_POST['iddept'];
$company = $_POST['company'];
$email = $_POST['mail'];


//Connexion to DB
$dbhandle = new DBController('WTDELTEC');

//Get new transaction based on user login
$sql="select *
    from employee
    where email = '".$email."'";

//echo $sql;
//Check if employee already exist
$numrows = $dbhandle->numRows($sql);


//Condition before inserting employee
if($numrows == 0) {
    
    //Get Department name    
     $resd = $dbhandle->runQuery( "select department
    from department
    where iddept='".$dept."'");
       if($resd) {
            foreach($resd as $keyd => $vald) {
               $deptm = $vald['department'];
            }
       }
     
     $insertSQL = "INSERT INTO [dbo].[employee]
           ([fullname]
           ,[login]
           ,[email]
           ,[jobtitle]
           ,[department]
           ,[company]
           ,[active]
           ,[roleid]
           ,[iddept])
     VALUES
           ('".$fname."'
           ,'".$login."'
           ,'".$email."'
           ,'".$jtitle."'
           ,'".$deptm."'
           ,'".$company."'
           ,1
           ,2
           ,'".$dept."')";
    
    $_SESSION['AEmsg'] = $dbhandle->insertQuery($insertSQL);
} else {
    //$_SESSION['AEmsg'] = "Employee already exist!";
}

//echo $insertSQL;
//echo  $_SESSION['AEmsg'];

//Rediriect the page to the current page
header("Location: ../index.php?pages=AddForms#home");
?>