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

//FX Class
require '../lib/dnfunctions.php';
$fx = new dnfunctions();

//Check token
if (!empty($_POST["csrf_token"])) {
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

           //Get value from form
           $idusr = $fx->sanitizeItem($_POST['usrid'], 'int');
           if((isset($_POST['tmpmdp1'])&&isset($_POST['tmpmdp2']))&&($_POST['tmpmdp1']==$_POST['tmpmdp2'])) {
               $pwd = password_hash($_POST['tmpmdp1'], PASSWORD_DEFAULT);
           } else {
               
               $_SESSION['msg'] = '<div class="alert alert-danger alert-mg-b" role="alert"><strong>Error: </strong>Password did not match!</div>'; 
               //Rediriect the page to the current page
               header('Location: ../index.php?dan=resetuserpwd');
           }

           if(isset($_POST['chp']) && ($_POST['chp']=='on')) {
               $chp = 1;
           } else {
               $chp = 1;
           }

               
           $PWDValue = array(
           'password' => $pwd,
           'chpwd' => $chp,
           'idusr' => $idusr
           );
   
       
           //Reset user password
           $rexec = $app->resetUserPwd($PWDValue,$dbc);
   
   
           if($rexec==1) {
           $_SESSION['msg'] = '<div class="alert alert-success" role="alert"><strong>Well done! </strong>User paassword has been reset!</div>';
           } else {
           $_SESSION['msg'] = '<div class="alert alert-danger alert-mg-b" role="alert"><strong>Error: </strong>User paassword has been not reset!</div>'; 
           }
   
   
           //Rediriect the page to the current page
           header('Location: ../index.php?dan=resetuserpwd');
   
    } else {
        // Reset token
        unset($_SESSION["csrf_token"]);
        $_SESSION['lalert'] = '<div class="alert alert-danger">CSRF token validation failed!</div>';
        ob_start();
        header("Location: ../index.php?dan=resetuserpwd");
        ob_end_flush();
        ob_end_clean();
    }
}
