<?php
  require 'includes/dbh.inc.php';
?>
<?php
  session_start();
?>
<!-- register-users-local.php?nsonum=3864&button= -->
<!-- onclick="resetForm()" -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

  <title>Sim Card Registration System</title>
  <!-- LOGO ON TAB -->
  <link rel="icon" href="images/logo.png">
  <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- CDN CSS FILE BOOTSTRAP VER 4.6 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

  <!-- CUSTOM CSS FILE  -->
  <link rel="stylesheet" href="styles/register.css">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>

</head>
  <body>
    <!-- NAVBAR PART -->
    <header>

      <nav class="navbar navbar-expand-lg">
        <a class="div1 navbar-brand" href="navbar.php">
            <img src="images/logo.png" width="30" height="32" class="d-inline-block align-top" alt="">
            <span class="brandname">SimCardRegistrationSystem</span>
          </a>

        <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">


        <ul class='navbar-nav'>
              <li class='nav-item'>
                <a class='nav-link selected' href='register-users-local.php'>Local User Registration</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='register-users-foreign.php'>Foreign User Registration</a>
              </li>

            </ul>



          <form class="form-btnn" action="#" method="POST">
            <button type="submit" name="btn-primary" class="log-button">Logout</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- BODY PART -->
    <div class="container">
      <div class="row header">
            <h2>Local User Sim Card Registration Form</h2>
          </div>

          <form class="" action="register-users-local.php" method="GET">
<?php
        $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(strpos($fulUrl, "signup=success") == true){
          echo "<p class= 'success'> SUCCESS</p>";
        }
        elseif(strpos($fulUrl, "error=simnum-already-exist") == true){
          echo "<p class= 'nsoexist'> ACCOUNT ALREADY EXIST</p>";
        }
        elseif(strpos($fulUrl, "no-result") == true){
          echo "<p class= 'nsoexist'> NO RESULT</p>";
        }


?>
<?php
// BUTTON CLICKED : WITH RESULTS
  if(isset($_GET['nsonum'])){
    $nso = $_GET['nsonum'];
    $query = "SELECT * FROM dummylocal WHERE nsonum =  '$nso'; ";
    $result = mysqli_query($conn,$query);

      if (mysqli_num_rows($result) > 0) {
        // if there is a result
        foreach ($result as $row) {
          ?>
        <!-- FIRST ROW -->
        <div class="row">

          <div class="col-md-3 infodiv">
            <label class="labelings">Last Name</label>
            <input id="lastname" type="text" name="lastname" class="form-control" value="<?= $row['lastname'] ?>" disabled>
          </div>

          <div class="col-md-3 infodiv">
            <label class="labelings">First Name</label>
            <input id="firstname" type="text" name="firstname" class="form-control" value="<?= $row['firstname'] ?>" disabled>
          </div>

          <div class="col-md-3 infodiv">
            <label class="labelings">Middle Name</label>
            <input id="midname" type="text" name="midname" class="form-control" value="<?= $row['midname'] ?>" disabled>
          </div>

          <div class="col-md-3">
            <label class="labelings">Suffix</label>
            <input type="text" name="suffix" class="form-control" value="<?= $row['suffix'] ?>" disabled>
          </div>

        </div>

        <!-- SECOND ROW -->
        <div class="row srow">
          <div class="col-md-3 infodiv">
            <label class="labelings">Date of Birth</label>
            <input id="dateofbirth" type="date" name="dateofbirth"  class="form-control" value="<?= $row['dateofbirth'] ?>" disabled>
          </div>
          <div class="col-md-3">
            <label class="labelings">Gender</label>
            <input  type="text" name="Gender"  class="Gender form-control" value="<?= $row['gender'] ?>" disabled>
          </div>
          <div class="col-md-6 infodiv">
            <label class="labelings">NSO Barcode Number</label>
            <input id="nsonum" type="text" name="nsonum" class="form-control"value="<?php
              if (isset($_GET['nsonum'])) {
                echo $_GET['nsonum'];
              }
             ?>" >
          </div>

        </div>

        <!-- THIRD ROW -->
        <div class="row srow">
          <div class="col-12 infodiv">
            <label class="Bday">Address</label>
            <input id="address" type="text" name="address" class="form-control" value="<?= $row['address'] ?>" disabled>
          </div>
        </div>

        <!-- BUTTON ROW -->
        <div class="row srow nsobutton">
          <div class="col-12 infodiv">
            <a href="register-users-local.php">
            <button type="submit" name="button" class="send-btn db" onclick="register-users-local.php" >Search Database</button></a>

        </div>
        </div>
        </form>
        <!-- END OF AUTOFILL -->
        <form class="" action="" method="POST">
          <!-- FOURTH ROW -->
          <div class="row">
            <div class="col-md-6">
              <label class="labelings">Type of Sim Card user</label>
              <select class="form-control" name="simcard">
                <option value="new prepaid user">New prepaid user</option>
                <option value="existing prepaid user">Existing prepaid user (Unregistered)</option>
                <option value="postpaid user">Postpaid user</option>
              </select>
            </div>
            <div class="col-md-6 infodiv">
              <label class="labelings">Register SIM number</label>
              <input id="simnum" type="tel" name="simnum" class="form-control" placeholder="ex: +639175901234" required>
            </div>
          </div>

          <!-- FIFTH ROW -->
          <div class="row srow">
            <div class="col-md-6 infodiv">
              <label class="labelings">Date of Registration</label>
              <input id="dateregis"type="date" name="dateofregis" class="form-control" required>
            </div>

            <div class="col-md-6 infodiv">
              <label class="labelings">Registration Site</label>
              <input id="regisite" type="text" name="regisite" class="form-control" placeholder="Cavite" required>
            </div>
          </div>

          <!-- PROCEED TO FINGERPRINT REGISTRATION BUTTON -->
        <div class="row srow">
          <button type="submit" name="button" class="send-btn">Proceed to Fingerprint Registration</button>
        </div>

        </form>
        <?php
        // DATA FROM AUTOFILL
        if(isset($_POST['button'])){
          $nso = $_GET['nsonum'];
          $query = "SELECT * FROM dummylocal WHERE nsonum =  '$nso'; ";
          $result = mysqli_query($conn,$query);

          if (mysqli_num_rows($result) > 0) {
            // if there is a result
            foreach ($result as $row) {
            $lastN = $row['lastname'];
            $firstN = $row['firstname'];
            $midN = $row['midname'];
            $sfx = $row['suffix'];
            $dob = $row['dateofbirth'];
            $gndr = $row['gender'];
            $nsonumber = $row['nsonum'];
            $address = $row['address'];
          }

          // DATA FROM REGIS
          $simcard = $_POST['simcard'];
          $simnum = $_POST['simnum'];
          $regisite = $_POST['regisite'];
          $dateofregis = date('Y-m-d', strtotime($_POST['dateofregis']));

          $sqlnso = "SELECT simnum FROM registerlocal WHERE simnum = $simnum";
          $result = mysqli_query($conn, $sqlnso);
          $resultsCheck = mysqli_num_rows($result);
          if($resultsCheck == 1){
            echo "<script> window.location.href='register-users-local.php?error=simnum-already-exist'; </script>";
             // window.location.href='http://localhost/Sim-Registration-Final-UI-main/register-users-local.php';
            // echo "<h2>Error</h2>";
            // header("Location: ../Sim-Registration-Final-UI-main/register-users-local.php?error=simnum-already-exist=nsonum='.$nso.'&button");
            // header("Location ../register-users-local.php?simnum-already-exist");

          }
          else {
          $sql = "INSERT INTO registerlocal (lastname, firstname, midname, suffix, dateofbirth, gender, nsonum, address,simcard, simnum,regisite,dateofregis)
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
          // PREPARED STATEMENT
          $stmt = mysqli_stmt_init($conn);
          // PREPARE THE PREPARE STATEMENT
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL statement failed";
          }else{
            mysqli_stmt_bind_param($stmt,"ssssssssssss",  $lastN, $firstN, $midN, $sfx, $dob, $gndr, $nsonumber, $address,$simcard, $simnum, $regisite, $dateofregis);
            // RUN PARAMETER INDSIDE DATABASE
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            echo "<script> window.location.href='register-users-local.php?signup=success'; </script>";
            // header("Location: ../Sim-Registration-Final-UI-main/register-users-local.php?signup=success=nsonum='.$nso.'&button");
             // header("Location: ../Sim-Registration-Final-UI-main/register-users-local.php?signup=success");
           }
         }
         mysqli_stmt_close($stmt);
         mysqli_close($conn);
       }
     }
     ?>
     <?php
   }
  } else {
    // header("http://localhost/Sim-Registration-Final-UI-main/register-users-local.php?nsonum=.$nso.&button=no-result");
    header("Location: ../Sim-Registration-Final-UI-main/register-users-local.php?no-result=nsonum='.$nso.'&button");
    // echo "NO RESULT";

  }
  }else {
    // INITIAL = NOT YET PRESSING BUTTON SEARCH DATABASE : EMPTY FIELD
  ?>
  <form class="" action="register-users-local.php" method="GET">
   <div class="row">
    <div class="col-md-3">
       <label class="labelings">Last Name</label>
       <input type="text" name="lastname" class="form-control" disabled>

       </div>

       <div class="col-md-3">
       <label class="labelings">First Name</label>
       <input type="text" name="firstname" class="form-control" disabled>
       </div>

       <div class="col-md-3">
       <label class="labelings">Middle Name</label>
       <input type="text" name="midname" class="form-control" disabled>
       </div>

       <div class="col-md-3">
       <label class="labelings">Suffix</label>
       <input type="text" name="suffix" class="form-control" disabled>
       </div>

       </div>

       <!-- SECOND ROW -->
       <div class="row srow">
         <div class="col-md-3 infodiv">
           <label class="labelings">Date of Birth</label>
           <input id="dateofbirth" type="date" name="dateofbirth"  class="form-control" disabled>
         </div>
         <div class="col-md-3">
           <label class="labelings">Gender</label>
           <input  type="text" name="Gender"  class="Gender form-control" disabled>
         </div>
         <div class="col-md-6 infodiv">
           <label class="labelings">NSO Barcode Number</label>
           <input id="nsonum" type="text" name="nsonum" class="form-control"value="<?php
             if (isset($_GET['nsonum'])) {
               echo $_GET['nsonum'];
             }
            ?>" >
         </div>

       </div>

       <!-- THIRD ROW -->
       <div class="row srow">
         <div class="col-12 infodiv">
           <label class="Bday">Address</label>
           <input id="address" type="text" name="address" class="form-control" disabled>
         </div>
       </div>

       <!-- BUTTON ROW -->
       <div class="row srow nsobutton">
         <div class="col-12 infodiv">
         <button type="submit" name="button" class="send-btn db" onclick="register-users-local.php">Search Database</button>
       </div>
       </div>
       </form>

   <form class="" action="" method="post">
       <!-- FOURTH ROW -->

       <div class="row">
         <div class="col-md-6">
           <label class="labelings">Type of Sim Card user</label>
           <select class="form-control" name="simcard">
             <option value="new prepaid user">New prepaid user</option>
             <option value="existing prepaid user">Existing prepaid user (Unregistered)</option>
             <option value="postpaid user">Postpaid user</option>
           </select>
         </div>
         <div class="col-md-6 infodiv">
           <label class="labelings">Register SIM number</label>
           <input id="simnum" type="tel" name="simnum" class="form-control" placeholder="ex: +639175901234" required>
         </div>
       </div>

       <!-- FIFTH ROW -->
       <div class="row srow">
         <div class="col-md-6 infodiv">
           <label class="labelings">Date of Registration</label>
           <input id="dateregis"type="date" name="dateofregis" class="form-control" required>
         </div>

         <div class="col-md-6 infodiv">
           <label class="labelings">Registration Site</label>
           <input id="regisite" type="text" name="regisite" class="form-control" placeholder="Cavite" required>
         </div>
       </div>

       <!-- PROCEED TO FINGERPRINT REGISTRATION BUTTON -->
     <div class="row srow">
       <button type="submit" name="button" class="send-btn">Proceed to Fingerprint Registration</button>
     </div>

     </form>


      <?php

  }
  ?>



</div>


<!-- end of body -->

 </body>
</html>
