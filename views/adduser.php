<?php
//FX Class
require './lib/dnfunctions.php';
$fx = new dnfunctions();

//Instanciate DB class
$dbc = new DBController();

//App Class
require './models/Users.php';

//Instatnciate app class
$app = new Users();

?>





<div class="container">
 
    <?php
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    <br/>

    <h1>
        <span>Add user</span>
        <a href="./index.php?dan=home"><button class='btn btn-secondary float-end'>User list</button></a>
    </h1>

    <form class="row g-3" action="./actions/adduserAction.php" method="post" enctype= multipart/form-data>
         <div class="col-md-12">
            <label for="inputName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="inputName" name="fname" required="required">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail4" name="email" required="required">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="mdp" required="required">
        </div>
        <div class="col-12">
            <label for="inputPhone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="inputPhone" placeholder="123 456 7890" name="phone">
        </div>
        <div class="col-12">
            <label for="formFile" class="form-label">User picture</label>
            <input class="form-control" type="file" id="formFile" name="pic">
        </div>
       
        <div class="col-md-12">
            <label for="inputState" class="form-label">User role</label>
            <select id="inputState" class="form-select" name="role" required="required">
            <option value="">Choose a user role</option>
            <?php
                $resd = $app->userRole($dbc);
                if($resd) {
                    foreach($resd as $keyd => $vald) {
                    echo '<option value="'.$vald['roleid'].'">'.$vald['role'].'</option>';
                    }
                }
            ?>
            </select>
        </div>

        <div class="col-12">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" name="chp">
            <label class="form-check-label" for="gridCheck">
                 Force to change password
            </label>
            </div>
        </div>
        <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>   

    </form>

</div>