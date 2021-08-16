<?php
/* 
 * COMPANY: DNAVAL (2021)
 * Author: Daniel Naval
 * Description: App Class (DNAVAL)
 */

class Users {
	
    /*******************************
     * Users Settings functions *
     *******************************/

    //Check Users Info
    public function checkUsersInfo($email, $dbc) {

        $query = "SELECT `idusr`, `fullname`, `email`, `phone`, `picture`, FROM `users` WHERE email ='".$email."'";
    
        $nbemp = $dbc->numRows($query);

        return $nbemp;
    }

   //get user ID
    public function getUserId($email, $dbc) {
        //Query to get user info
        $query = "SELECT `idusr` FROM `users` WHERE login ='".$email."'";
    
        $empid = $dbc->runQuery($query);

        foreach($empid as $val) {
            $ID = $val['idusr'];
        }

        return $ID;
    }
    

    //Add user info
    public function addUserInfo($data_arr, $dbc) {
         //Insert query
         $sql = "INSERT INTO `users`(`fullname`, `email`, `password`, `phone`, `picture`, `active`, `roleid`, `chpwd`)"
         . "VALUES (:fullname, :email, :password, :phone, :picture, :active, :roleid, :chpwd)";

        //Prepare the query
        $res = $dbc->execQuery($sql, $data_arr);

	    return $res;
    }

    //Update user info
    public function editUserInfo($data_arr, $dbc) {
        //Update query
        $sql = "UPDATE `users`
        SET fullname=:fullname, email=:email, phone=:phone, picture=:picture, active=:active, roleid =:roleid, chpwd=:chpwd
        WHERE `idusr`=:idusr";

       //Prepare the query
       $res = $dbc->execQuery($sql, $data_arr);

       return $res;
   }

   //Reset user password
   public function resetUserPwd($data_arr, $dbc) {
    //Update query
    $sql = "UPDATE `users`
    SET `password`=:password, chpwd=:chpwd
    WHERE `idusr`=:idusr";

   //Prepare the query
   $res = $dbc->execQuery($sql, $data_arr);

   return $res;
}

   //Delete a user
   public function deleteUser($ID, $dbc) {
    //Update query
    $sql = "DELETE FROM `users` WHERE `idusr`=".$ID."";

   //Prepare the query
   $res = $dbc->execQueryOnly($sql);

   return $res;
}

   //Get user info
    public function getUserInfo($ID, $dbc) {
        //Query to get user info
        $query = "SELECT `idusr`, `fullname`, `email`, `password`, `phone`, `picture`, `active`, `roleid`, `chpwd` FROM users WHERE idusr='".$ID."'";

        //Get value from query
        $result_item[] = $dbc->runQuery($query);

        foreach($result_item as $val) {
             return $val;
        }
    }



      //Get activ user list
      public function userList($dbc) {
            $query = "SELECT d.idusr
                ,d.fullname
                ,d.email
                ,d.phone
                ,d.picture
                ,case when d.active=1 then 'YES' else 'NO' end as active
                ,r.role
            FROM users d
            left join `role` r on d.roleid = r.roleid
            WHERE d.active=1";
            
            //Get value from query
            $result_item[] = $dbc->runQuery($query);

            foreach($result_item as $val) {
                return $val;
            }
      }

      //Get all user list
      public function allUsers($dbc) {
            $query = "SELECT * FROM users WHERE active=1";
            
            //Get value from query
            $result_item[] = $dbc->runQuery($query);

            foreach($result_item as $val) {
                return $val;
            }
       }

       //Get user role
       public function userRole($dbc) {
            $query = "SELECT * FROM `role`";
                
            //Get value from query
            $result_item[] = $dbc->runQuery($query);

            foreach($result_item as $val) {
                return $val;
            }
        }


}
