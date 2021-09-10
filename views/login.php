<?php

//FX Class
require './lib/dnfunctions.php';
$fx = new dnfunctions();

?>

<style>
.bd-placeholder-img {
font-size: 1.125rem;
text-anchor: middle;
-webkit-user-select: none;
-moz-user-select: none;
user-select: none;
}

@media (min-width: 768px) {
.bd-placeholder-img-lg {
    font-size: 3.5rem;
}
}

html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

<main class="form-signin text-center">
    <?php
        if(isset($_SESSION['lalert'])) {
            echo $_SESSION['lalert'];
            unset($_SESSION['lalert']);
        }
    ?>
    <?php if((empty($_GET['chp']))||($_GET['chp']!=1)) {?>
        <!-- <h1>Login to UserAdmin</h1> -->
    
        <div class="login-form">
            <form method="post" action="./actions/conAction.php">

                <img class="mb-4" src="./images/Naval_Daniel_Logo.png" alt="" width="90" height="90">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="log">
                <label for="floatingInput">Email address</label>
                </div>

                <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="mdp">
                <label for="floatingPassword">Password</label>
                </div>

                <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
               
                <button class="w-100 btn btn-lg btn-primary" type="submit">LOG-IN</button>

            </form>
        </div>

    <?php } else { ?>

        <h1>Reset your password</h1>
    
        <div class="login-form">
            <form method="post" action="./actions/conAction.php">

                <img class="mb-4" src="./images/Naval_Daniel_Logo.png" alt="" width="90" height="90">
                <h1 class="h3 mb-3 fw-normal">Please reset you password</h1>

                <div class="form-floating">
                <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="pass1">
                <label for="floatingInput">Email address</label>
                </div>

                <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass2">
                <label for="floatingPassword">Password</label>
                </div>

                <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
               
                <button class="w-100 btn btn-lg btn-primary" type="submit">RESET</button>

            </form>
        </div>
    <?php } ?>    
</main>
