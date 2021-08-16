<?php

//FX Class
require './lib/dnfunctions.php';
$fx = new dnfunctions();

?>


<div class="container">
    <?php
        if(isset($_SESSION['lalert'])) {
            echo $_SESSION['lalert'];
            unset($_SESSION['lalert']);
        }
    ?>
    <?php if((empty($_GET['chp']))||($_GET['chp']!=1)) {?>
        <h1>Login to UserAdmin</h1>
    
        <div class="login-form">
            <form method="post" action="./actions/conAction.php">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                    <input type="email" class="form-control" id="inputEmail3" name="log">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-4">
                    <input type="password" class="form-control" id="inputPassword3" name="mdp">
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
                
                <button type="submit" class="btn btn-primary">LOG-IN</button>

            </form>
        </div>

    <?php } else { ?>

        <h1>Reset your password</h1>
    
        <div class="login-form">
            <form method="post" action="./actions/conAction.php">

                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-4">
                    <input type="password" class="form-control" id="inputPassword3" name="pass1">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-4">
                    <input type="password" class="form-control" id="inputPassword3" name="pass2">
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
                
                <button type="submit" class="btn btn-primary">RESET</button>

            </form>
        </div>
    <?php } ?>    
</div>


