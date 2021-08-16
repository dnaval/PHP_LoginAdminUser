<?php
/* 
 * Company: DNAVAL
 * Author: Daniel Naval
 * Department: PHP Web Developer
 * Date: 20210810
 * Utility functions
 */

 class dnfunctions {
    private $tname;
    private $namefile;
    private $uploaddir = '../uploads';

    public function dn_uploadfile($tname,$namefile){
          if(move_uploaded_file($tname,$this->uploaddir.'/'.$namefile)) {
              $res =1;
          } else {
              $res = 0;
          }
          return $res;
    }

    public function removeSpecialChars($string) {
        $str = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
        return $str;
    }

    public function sanitizeItem($var, $type)
    {
        $flags = NULL;
        switch($type)
        {
            case 'url':
                $filter = FILTER_SANITIZE_URL;
            break;
            case 'int':
                $filter = FILTER_SANITIZE_NUMBER_INT;
            break;
            case 'float':
                $filter = FILTER_SANITIZE_NUMBER_FLOAT;
                $flags = FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND;
            break;
            case 'string':
            default:
                $filter = FILTER_SANITIZE_STRING;
                $flags = FILTER_FLAG_NO_ENCODE_QUOTES;
            break;

        }
        $output = filter_var($var, $filter, $flags);        
        return($output);
    }

    public function sanitizeDate($string) {
        $str = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($input)));
        return $str;
    }
    public function sanitizeEmail($email) {
        if (filter_var($email,FILTER_VALIDATE_EMAIL)){
            $clean_email =  filter_var($email,FILTER_SANITIZE_EMAIL);
        } 
        return $clean_email;
    }

    public function gen_token() {
        // Check if a token is present for the current session
        if(!isset($_SESSION["csrf_token"])) {
            // No token present, generate a new one
            $token = bin2hex(random_bytes(32));
            $_SESSION["csrf_token"] = $token;
        } else {
            // Reuse the token
            $token = $_SESSION["csrf_token"];
        }
        return $token;
    }

 }