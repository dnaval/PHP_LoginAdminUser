<?php
//Start Session 
session_start();

//Include IndexController page
require_once './controllers/IndexController.php';

//DBController Class
require './models/DBController.php';

//Set today's date
date_default_timezone_set('America/Nassau');
$today = date("Y-m-d");
$year = date("Y");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>User Admin App</title>
  </head>
  <body>


  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="./images/Naval_Daniel_Logo.png" alt="Naval Daniel Logo">  
        User Admin
      </a>
      <div class="d-flex">
              <?php if(isset($_SESSION['UID']) && isset($_SESSION['username'])) { ?>
                  Hello <?php echo $_SESSION['username']; ?>&nbsp; | &nbsp; 
                  <a href="./logout.php">Logout</a>
              <?php } ?>

      </div>

    </div>
  </nav>
  
  <br/>

     <!-- CONTENT -->
        <?php
        //Check the variable
        if(isset($_GET['dan'])) {
            $page = $_GET['dan'];
        } else {
            $page='';
        }

        if(isset($_SESSION['UID'])) {
            $UID = $_SESSION['UID'];
        } else {
            $UID='';
        }

        //Instantiate Controller
        $index = new IndexController();

        //Display Page
        $index->displayPage($page,$UID);
        ?>     
      <!-- END CONTENT -->

      <!-- Footer -->
      <footer class="text-center text-lg-start bg-light text-muted">
          <!-- Copyright -->
          <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © <?php echo $year; ?> Copyright 
            <a class="text-reset fw-bold" href="https://www.linkedin.com/in/daniel-naval-a4a81551/?lipi=urn%3Ali%3Apage%3Ad_flagship3_feed%3BBeYqnQ5jQye%2B4%2BpqnVH11g%3D%3D">Daniel Naval</a>
          </div>
          <!-- Copyright -->
      </footer>
      <!-- Footer -->

    <!--  JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    
  </body>
</html>