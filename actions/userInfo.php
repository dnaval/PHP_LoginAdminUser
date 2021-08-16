<?php
//FX Class
require '../lib/dnfunctions.php';
$fx = new dnfunctions();

//DBController Class
require '../models/DBController.php';

//Instanciate DB class
$dbc = new DBController();

//App Class
require '../models/Users.php';

//Instatnciate app class
$app = new Users();


//Get user info for edit form
if($_POST['rowid']) {
    $id = $_POST['rowid']; 
    $info = $app->getUserInfo($id, $dbc);
    foreach($info as $val) {
?>
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit user ID : <?php echo $val['idusr']; ?></h5>
        <input type="hidden" name="uid" value="<?php echo $val['idusr']; ?>">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    
                <div class="col-md-12">
                    <label for="inputName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="inputName" name="fname" value="<?php echo $val['fullname']; ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo $val['email']; ?>">
                </div>
                <div class="col-12">
                    <label for="inputPhone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="inputPhone" placeholder="123 456 7890" name="phone" value="<?php echo $val['phone']; ?>">
                </div>
                <div class="col-12">
                    <label for="formFile" class="form-label">User picture</label>
                    <input class="form-control" type="file" id="formFile" name="pic">
                    <input type="hidden" name="picture" value="<?php echo $val['picture']; ?>">
                </div>
                <div class="col-md-6">
                    <?php
                       if($val['active']==1) {
                           $y = "checked";
                           $n = "";
                       } else {
                           $y = "";
                           $n = "checked";
                       }
                    ?>
                    <label for="inputActive" class="form-label">Active</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" <?php echo $y; ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault2" <?php echo $n; ?>>
                        <label class="form-check-label" for="flexRadioDefault2">
                            No
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">User role</label>
                    <select id="inputState" class="form-select" name="role">
                    <option selected>Choose a user role</option>
                    <?php
                        $resd = $app->userRole($dbc);
                        if($resd) {
                            foreach($resd as $keyd => $vald) {
                                if($val['roleid']==$vald['roleid']) {
                                    echo '<option value="'.$vald['roleid'].'" selected>'.$vald['role'].'</option>';
                                } else {
                                    echo '<option value="'.$vald['roleid'].'">'.$vald['role'].'</option>';
                                }
                            }
                        }
                    ?>
                    </select>
                </div>

                <div class="col-12">
                    <?php
                       if($val['chpwd']==1) {
                           $chp = "checked";
                       } else {
                           $chp = "";
                       }
                    ?>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="chp" <?php echo $chp; ?>>
                    <label class="form-check-label" for="gridCheck">
                        Force to change password
                    </label>
                    </div>
                </div>
        </div>
                
<?php

    }
 }
?>