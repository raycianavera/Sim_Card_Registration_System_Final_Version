<?php
  require "register-nav.php";
?>

<!-- BODY PART -->
<div class="container">
<?php

if (isset($_GET['foreign'])) {

    echo '
      <div class="row header">
        <h2>Foreign User Sim Card Registration Form</h2>
      </div>
<!--      <form class="" action="includes/signupforeign.inc.php" method="post"> -->

          <form class="" action="register-users.php?foreign=fromautofill" method="post">
    ';

        $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(strpos($fulUrl, "signup=success") == true){
          echo "<p class= 'success'> SUCCESS</p>";
        }
        elseif(strpos($fulUrl, "error=simnum-already-exist") == true){
          echo "<p class= 'passnumexist'> ACCOUNT ALREADY EXIST</p>";
        }

        echo '
            <!-- FIRST ROW -->
            <div class="row">
              <div class="col-md-3">
                <label class="labelings">Last Name</label>
                <input type="text" name="lastname" class="form-control" placeholder="Reeves" required>
              </div>

              <div class="col-md-3">
                <label class="labelings">First Name</label>
                <input type="text" name="firstname" class="form-control" placeholder="Keanu" required>
              </div>

              <div class="col-md-3">
                <label class="labelings">Middle Name</label>
                <input type="text" name="midname" class="form-control" placeholder="Charles">
              </div>

              <div class="col-md-3">
                <label class="labelings">Suffix</label>
                <input type="text" name="suffix" class="form-control" placeholder="Sr">
              </div>

            </div>

            <!-- SECOBD ROW -->
            <div class="row srow">
              <div class="col-md-3">
                <label class="labelings">Date of Birth</label>
                <input type="date" name="dateofbirth" class="form-control" required>
              </div>
              <div class="col-md-3 ">
                <label class="labelings">Gender</label>
                <select class="Gender form-control" name="Gender">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="col-md-6 ">
                <label class="labelings">Passport Number</label>
                <input type="text" name="passnum" class="form-control" required>
              </div>

            </div>

            <!-- THIRD ROW -->

            <div class="row srow">
              <div class="col-md-6">
                <label class="labelings">Nationality</label>
                <input type="text" name="nationality" class="form-control" placeholder="American" required>
              </div>
              <div class="col-md-6">
                <label class="labelings">Sim Card Mobile # to be Registered</label>
                <input type="tel" name="simnum" class="form-control" placeholder="ex: +639175901234" required>
              </div>
            </div>

            <!-- BUTTON ROW -->
            <div class="row srow nsobutton">
              <div class="col-12 infodiv">
              <button type="submit" name="button" class="send-btn db">Search Database</button>
            </div>
            </div>

            </form>

<form class="" action="register-users.php?foreign=datetimeregisite" method="post">
            <!-- FOURTH ROW -->
            <div class="row">
              <div class="col-md-4">
                <label class="labelings">Date of Registration</label>
                <input type="date" name="dateofregis" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="labelings">Time of Registration</label>
                <input type="time" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="labelings">Registration Site</label>
                <input type="text" name="regisite" class="form-control" placeholder="Cavite" required>
              </div>
            </div>

            <!-- PROCEED TO FINGERPRINT REGISTRATION BUTTON -->
          <div class="row srow">
            <button type="submit" name="button" class="send-btn">Proceed to Fingerprint Registration</button>
          </div>

          </form>

        ';
} else {
  echo ' <div class="row header">
        <h2>Local User Sim Card Registration Form</h2>
      </div>
<!--      <form id="form" class="" action="includes/signuplocal.inc.php" method="post"> -->

      <form class="" action="register-users.php?fromautofill" method="post">

      ';


        $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(strpos($fulUrl, "signup=success") == true){
          echo "<p class= 'success'> SUCCESS</p>";
        }
        elseif(strpos($fulUrl, "error=simnum-already-exist") == true){
          echo "<p class= 'nsoexist'> ACCOUNT ALREADY EXIST</p>";
        }

echo '
        <!-- FIRST ROW -->
        <div class="row">

          <div class="col-md-3 infodiv">
            <label class="labelings">Last Name</label>
            <input id="lastname" type="text" name="lastname" class="form-control" placeholder="Dela Cruz" required>
          </div>

          <div class="col-md-3 infodiv">
            <label class="labelings">First Name</label>
            <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Juan" required>
          </div>

          <div class="col-md-3 infodiv">
            <label class="labelings">Middle Name</label>
            <input id="midname" type="text" name="midname" class="form-control" placeholder="Reyes" required>
          </div>

          <div class="col-md-3">
            <label class="labelings">Suffix</label>
            <input type="text" name="suffix" class="form-control" placeholder="Jr">
          </div>

        </div>

        <!-- SECOBD ROW -->
        <div class="row srow">
          <div class="col-md-3 infodiv">
            <label class="labelings">Date of Birth</label>
            <input id="dateofbirth" type="date" name="dateofbirth"  class="form-control" required>
          </div>
          <div class="col-md-3">
            <label class="labelings">Gender</label>
            <select class="Gender form-control" name="Gender" required>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-md-6 infodiv">
            <label class="labelings">NSO Barcode Number</label>
            <input id="nsonum" type="text" name="nsonum" class="form-control" required>
          </div>

        </div>

        <!-- THIRD ROW -->
        <div class="row srow">
          <div class="col-12 infodiv">
            <label class="Bday">Address</label>
            <input id="address" type="text" name="address" class="form-control" placeholder="Blk 5 Lot 11 Ph 2, Jerusalem St, Town and Country, Salitran 4, Dasmarinas City, Cavite" required>
          </div>
        </div>

        <!-- BUTTON ROW -->
        <div class="row srow nsobutton">
          <div class="col-12 infodiv">
          <button type="submit" name="button" class="send-btn db">Search Database</button>
        </div>
        </div>
        </form>

    <form class="" action="register-users.php?datetimeregisite" method="post">
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
            <label class="labelings">Sim Card Mobile # to be Registered</label>
            <input id="simnum" type="tel" name="simnum" class="form-control" placeholder="ex: +639175901234" required>
          </div>
        </div>

        <!-- FIFTH ROW -->
        <div class="row srow">
          <div class="col-md-4 infodiv">
            <label class="labelings">Date of Registration</label>
            <input id="dateregis"type="date" name="dateofregis" class="form-control" required>
          </div>
          <div class="col-md-4 infodiv">
            <label class="labelings">Time of Registration</label>
            <input id="timeregis" type="time" class="form-control" required>
          </div>
          <div class="col-md-4 infodiv">
            <label class="labelings">Registration Site</label>
            <input id="regisite" type="text" name="regisite" class="form-control" placeholder="Cavite" required>
          </div>
        </div>

        <!-- PROCEED TO FINGERPRINT REGISTRATION BUTTON -->
      <div class="row srow">
        <button type="submit" name="button" class="send-btn">Proceed to Fingerprint Registration</button>
      </div>

      </form>';
}

  ?>






 </div>


<!-- end of body -->

  </body>
</html>
