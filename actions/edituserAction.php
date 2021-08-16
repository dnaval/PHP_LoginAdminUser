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
           $idusr = $role = $fx->sanitizeItem($_POST['uid'], 'int');
           $fullname = $fx->sanitizeItem($_POST['fname'], 'string');
           $email = $fx->sanitizeEmail($_POST['email']);
           $phone = $fx->sanitizeItem($_POST['phone'], 'string');
           $role = $fx->sanitizeItem($_POST['role'], 'int');
   
           if(isset($_POST['chp']) && ($_POST['chp']=='on')) {
               $chp = 1;
           } else {
               $chp = 0;
           }
           
           if(isset($_FILES['pic']['name']) && ($_FILES['pic']['name'] != null)) {
                $pic_emp = 'DNAVAL_'.time().'_'.$_FILES['pic']['name'];

                //File uploaded
                $tname_emp = $_FILES['pic']['tmp_name'];
                $resupload = $fx->dn_uploadfile($tname_emp,$pic_emp);
           } else {
                $pic_emp = $fx->sanitizeItem($_POST['picture'], 'string');
           }
               
           $USRValue = array(
           'fullname' => $fullname,
           'email' => $email,
           'phone' => $phone,
           'picture' => $pic_emp,
           'active' => 1,
           'roleid' => $role, 
           'chpwd' => $chp,
           'idusr' => $idusr
           );
       
           //Edit user
           $rexec = $app->editUserInfo($USRValue,$dbc);
   
   
           if($rexec==1) {
           $_SESSION['msg'] = '<div class="alert alert-success" role="alert"><strong>Well done! </strong>User have been updated!</div>';
           } else {
           $_SESSION['msg'] = '<div class="alert alert-danger alert-mg-b" role="alert"><strong>Error: </strong>User have not been updated!</div>'; 
           }
   
   
           //Rediriect the page to the current page
           header('Location: ../index.php?dan=home');
   
    } else {
        // Reset token
        unset($_SESSION["csrf_token"]);
        $_SESSION['lalert'] = '<div class="alert alert-danger">CSRF token validation failed!</div>';
        ob_start();
        header("Location: ../index.php?dan=home");
        ob_end_flush();
        ob_end_clean();
    }
}