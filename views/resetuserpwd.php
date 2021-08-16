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
        <span>Reset user password</span>
        <a href="./index.php?dan=home"><button class='btn btn-secondary float-end'>User list</button></a>
    </h1>

    <form class="row g-3" action="./actions/chpwduserAction.php" method="post">

       
        <div class="col-md-12">
            <label for="inputState" class="form-label">User role</label>
            <select id="inputState" class="form-select" name="usrid" required="required">
            <option value="">Choose a user</option>
            <?php
                $resd = $app->allUsers($dbc);
                if($resd) {
                    foreach($resd as $keyd => $vald) {
                    echo '<option value="'.$vald['idusr'].'">'.$vald['fullname'].'</option>';
                    }
                }
            ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Temp Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="tmpmdp1" required="required">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Confirm Temp Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="tmpmdp2" required="required">
        </div>

        <div class="col-12">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" name="chp" checked>
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