<?php 
//Start Session 
session_start();

//DBController Class
require '../models/DBController.php';

// Instantiate DB
$dbc= new DBController();

 if (isset($_POST["pass1"])&&isset($_POST["pass2"])&&isset( $_SESSION['UID'])) {
        
     if($_POST["pass1"] == $_POST["pass2"])
     {
         $sqlUpdate = "UPDATE users SET `password`='".password_hash($_POST["pass1"], PASSWORD_DEFAULT)."',chpwd=0 WHERE idusr = '". $_SESSION['UID']."' ";
         $dbc->execQueryOnly($sqlUpdate); 
        
         $_SESSION['lalert'] = '<div class="alert alert-success" role="alert"><strong>Well done! </strong>Please login with your new password!</div>';
         ob_start();
         header("Location: ../index.php");
         ob_end_flush();
         ob_end_clean();
        
     } else {
         $_SESSION['lalert'] = '<div class="alert alert-danger">The passwords did not match, please try again!</div>';
         ob_start();
         header("Location: ../index.php?dan=login");
         ob_end_flush();
         ob_end_clean();
    }
    


 } else {

    if (!empty($_POST["csrf_token"])) {
        if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
  
            //Recuperation des valeur du login
            if (isset($_POST["log"])&&isset($_POST["mdp"])) {
                $pseudo = filter_var($_POST["log"], FILTER_SANITIZE_EMAIL);
                $mdp = htmlspecialchars_decode(trim($_POST["mdp"]));
            } 

            //Verify if the user password is forced to change.
            $danQuery = "SELECT * FROM users WHERE email='$pseudo' AND chpwd=1 AND active=1";
            $n = $dbc->numRows($danQuery);


            if($n==0) {
                    //selection de l'id utilisateur
                    $sqlCon = "SELECT idusr, fullname, email, `password`, active, roleid FROM users WHERE `email`='$pseudo' AND chpwd=0 AND active=1";
                    $resultC = $dbc->runQuery($sqlCon);


                      if ($resultC) { 
                          foreach ($resultC as $keyC => $valC ) 
                          {
                              $pchk = password_verify($mdp, $valC['password']);
                            if (($pseudo==$valC['email'])&&($pchk==1)) {
                                 $_SESSION['UID'] = $valC['idusr'];
                                 $_SESSION['role']=$valC['roleid'];
                                $_SESSION['login'] = $valC['email'];
                                 $_SESSION['username'] = $valC['fullname'];
                            }
                        }
                    
                      }

                       if(isset($_SESSION['UID'])) {
                           header("Location: ../index.php?dan=home");
                      } else {
                           $_SESSION['lalert'] = '<div class="alert alert-danger">The user or password are not correct, please try again!</div>';
                           header("Location: ../index.php?dan=login");
                       }
                

             } else {
                //selection de l'id utilisateur
                 $sqlR = "SELECT idusr, chpwd FROM `users` WHERE `email`='$pseudo'";
                 $resultR = $dbc->runQuery($sqlR);
                
                 if ($resultR) { 
                         foreach ($resultR as $keyR => $valR) 
                         {
                             $_SESSION['UID'] = $valR['idusr'];
                             $_SESSION['CHP'] = $valR['chpwd'];
                         }

                 }
                 ob_start();
                    header("Location: ../index.php?dan=login&chp=1");
                 ob_end_flush();
                 ob_end_clean();
             }
         } else {
             // Reset token
             unset($_SESSION["csrf_token"]);
             $_SESSION['lalert'] = '<div class="alert alert-danger">CSRF token validation failed!</div>';
             ob_start();
             header("Location: ../index.php?dan=login");
             ob_end_flush();
             ob_end_clean();
         }
    }

}


 ?>
