<?php
//Start Session 
session_start();

//DBController Class
require '../models/DBController.php';

// Instantiate DB
$dbc= new DBController();

//App Class
require '../models/Users.php';

//Instantiate app class
$app = new Users();

if(isset($_GET['ID'])) {
    //Delete User
    $sup = $app->deleteUser($_GET['ID'], $dbc);
    
    if($sup==1) {
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert"><strong>Well done! </strong>User has been removed!</div>';
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-mg-b" role="alert"><strong>Error: </strong>User has not been removed!</div>'; 
    }
}

//Rediriect the page to the current page
header('Location: ../index.php?dan=home');