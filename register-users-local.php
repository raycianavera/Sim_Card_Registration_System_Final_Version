<?php
  require 'includes/dbh.inc.php';

?>
<?php
  session_start();
  if (empty($_SESSION['SellerFirstName'])){
    header("Location: index.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

  <title>SimCardRegistrationSystem</title>
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

    <header>

      <nav class="navbar navbar-expand-lg">
        <a class="div1 navbar-brand" href="register-users-local.php">
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

          <form class="form-btnn" action="Logout/logoutprocess_SimRetailer.php" method="POST">
            <button type="submit" name="btn-primary" class="log-button">Logout</button>
          </form>
        </div>
      </nav>
    </header>

    <div class="container">
      <div class="row header">
            <h2>Local User Sim Card Registration Form</h2>
          </div>

          <form class="" action="register-users-local.php" method="GET">
<?php
        $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(strpos($fulUrl, "signup=success") == true){
          echo "<p class= 'regsuccess'>USER SUCCESSFULLY REGISTERED</p>";
        }
        elseif(strpos($fulUrl, "error=simnum-already-exist") == true){
          echo "<p class= 'nsoexist'>REGISTRATION FAILED: THIS SIM CARD NUMBER ALREADY EXISTS</p>";
        }
        elseif(strpos($fulUrl, "no-result") == true){
          echo "<p class= 'nsoexist'>USER NOT FOUND ON NSO DATABASE</p>";
        }


        elseif(strpos($fulUrl, "incorrectNum")==true){
        echo "<p class= 'nsoexist'>Incorrect mobile number input format. Please make sure the digit length is correct</p>";
        }
      elseif(strpos($fulUrl, "missplus")==true){
        echo "<p class= 'nsoexist'>Incorrect mobile number input format. Please use the +63 format and input digits only</p>";
        }
      elseif(strpos($fulUrl, "wrongchars")==true){
        echo "<p class= 'nsoexist'>Invalid characters detected. Please enter numbers only</p>";
        }


        elseif(strpos($fulUrl, "imageempty") == true){
          echo "<p class= 'nsoexist'>NO FINGERPRINT IMAGE UPLOADED</p>";
        }
        elseif(strpos($fulUrl, "imagelarge") == true){
          echo "<p class= 'nsoexist'>FINGERPRINT IMAGE SIZE IS TOO LARGE</p>";
        }
        elseif(strpos($fulUrl, "imageerror") == true){
          echo "<p class= 'nsoexist'>There was an error that occurred while processing the fingerprint image. Please re-upload the fingerprint image</p>";
        }
        elseif(strpos($fulUrl, "imageformaterror") == true){
          echo "<p class= 'nsoexist'>Please upload the fingerprint image in .jpg, .jpeg, .png, or .bmp only</p>";
        }




?>
<?php

  if(isset($_GET['nsonum'])){
    $nso = $_GET['nsonum'];
    $query = "SELECT * FROM nso_dummy_db WHERE nsonum =  '$nso'; ";
    $result = mysqli_query($conn,$query);

      if (mysqli_num_rows($result) > 0) {

        foreach ($result as $row) {
          ?>

        <div class="row">

          <div class="col-md-3 infodiv">
            <label class="labelings">Last Name</label>
            <input id="lastname" type="text" name="lastname" class="form-control" value="<?= $row['lastname'] ?>">
          </div>

          <div class="col-md-3 infodiv">
            <label class="labelings">First Name</label>
            <input id="firstname" type="text" name="firstname" class="form-control" value="<?= $row['firstname'] ?>">
          </div>

          <div class="col-md-3 infodiv">
            <label class="labelings">Middle Name</label>
            <input id="midname" type="text" name="midname" class="form-control" value="<?= $row['midname'] ?>">
          </div>

          <div class="col-md-3">
            <label class="labelings">Suffix</label>
            <input type="text" name="suffix" class="form-control" value="<?= $row['suffix'] ?>">
          </div>

        </div>


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
                $_SESSION['nsonumber'] = $_GET['nsonum'];
              }
             ?>" >
          </div>

        </div>


        <div class="row srow nsobutton">
          <div class="col-12 infodiv">
            <a href="register-users-local.php">
            <button type="submit" name="button" class="send-btn db" onclick="register-users-local.php" >Search Database</button></a>

        </div>

        </div>
        </form>

        <form class="" action="includes/register_fingerprint.php" method="POST" enctype='multipart/form-data'>

          <div class="row">
            <div class="col-12 infodiv">
              <label class="Bday">Address</label>
              <input id="address" type="text" name="address" class="form-control" required>
            </div>
          </div>

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

          <div class="row srow">
            <div class="col-md-6 infodiv">
              <label class="labelings">Date of Registration</label>
              <input id="dateregis"type="date" name="dateofregis" class="form-control" required>
            </div>

            <div class="col-md-6 infodiv">
              <label class="labelings">Registration Site</label>
              <input id="regisite" type="text" name="regisite" class="form-control" placeholder="e.g: Cavite" required>
            </div>

          </div>

          <div class="row srow">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlFile1">Attach Fingerprint Image</label>
                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
              </div>
            </div>

            <div class="col-md-6">
              <button type="submit" name="register" class="send-btn">Register User</button>
        </div>
        </div>

        </form>

       <?php
   }
  } else {
    header("Location: ../Sim_Card_Registration_System_Final_Version/register-users-local.php?no-result=nsonum='.$nso.'&button");

  }
  }else {
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


       <div class="row srow nsobutton">
         <div class="col-12 infodiv">
         <button type="submit" name="button" class="send-btn db" onclick="register-users-local.php">Search Database</button>
       </div>

       </div>
       </form>

   <form class="" action="includes/register_fingerprint.php" method="post" enctype="multipart/form-data">
       <div class="row">
         <div class="col-12 infodiv">
           <label class="Bday">Address</label>
           <input id="address" type="text" name="address" class="form-control" required>
         </div>
       </div>

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

       <div class="row srow">
         <div class="col-md-6 infodiv">
           <label class="labelings">Date of Registration</label>
           <input id="dateregis"type="date" name="dateofregis" class="form-control" required>
         </div>

         <div class="col-md-6 infodiv">
           <label class="labelings">Registration Site</label>
           <input id="regisite" type="text" name="regisite" class="form-control" placeholder="e.g: Cavite" required>
         </div>

       </div>

       <div class="row srow">
         <div class="col-md-6">
           <div class="form-group">
             <label for="exampleFormControlFile1">Attach Fingerprint Image</label>
             <input type="file" name='file' class="form-control-file" id="exampleFormControlFile1">
           </div>
         </div>

         <div class="col-md-6">
           <button type="submit" name="register" class="send-btn">Register User</button>
     </div>
     </div>

     </form>
      <?php

  }
  ?>
</div>
 </body>
</html>
