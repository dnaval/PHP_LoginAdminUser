<?php

/* 
 * Index Controller get the view pages from URL variable
 * Author: Daniel Naval
 * IndexController.php
 */
class IndexController {
   public function displayPage($page, $UID) {         
        if (!empty($UID) && !empty($page)) {

                //Affichage du contenu des formulaires
                  $fic = './views/'.$page.'.php';
                  if (file_exists($fic)) {
                          include($fic);
                  } else {
                          include("./views/home.php");
                  }

        } else {
                  include("./views/login.php");
        }
    }
}