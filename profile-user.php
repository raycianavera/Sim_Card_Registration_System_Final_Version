<?php
  require "navbar.php";
  include_once 'dbh/EndUser.inc.php';

  $SimCardNumber = $_SESSION['UserNumber'] ;
  $LastName      = $_SESSION['UserLast']  ;
  $FirstName     = $_SESSION['UserFirst']  ;
  $Gender        = $_SESSION['UserGender']  ;
  $Birthdate     = $_SESSION['UserBirthdate'];
  $Address       = $_SESSION['UserAddress']  ;
  $Nationality   = $_SESSION['UserNationality'];
  $TypeofUser    = $_SESSION['UserType'] ;
  $DateofRegist  = $_SESSION['UserDatReg'];
  $TimeofReg     = $_SESSION['UserTimeReg'];
  $RegSite       = $_SESSION['UserRegSite'] ;
  $SimCard       = $_SESSION['UserSimCard']  ;
  $MiddleName    = substr($_SESSION['UserMiddleName'],0,1);
  $Suffix        = " ".$_SESSION['UserSuffix']." ";
  $MiddleName    = $MiddleName.".";

?>


<!-- BODY PART -->
<div class="container">
  <?php
    if (isset($_GET['reportPage'])) {
      echo " <div class='row header'>
      <h2>Report a malicious number</h2>
    </div>
    <div class='row'>
      <div class='col-md-6 iconn'>
        <!-- COLUMN 1 -->
        <form class='' id='form' action='UserprofileBackEnd/BackEnd_Report.php' method='post' enctype='multipart/form-data'>
          <div class='infodiv1'>
            <p class='labelings'>Name</p>
            <input type='text' name='VictName' value='$FirstName $LastName $MiddleName $Suffix 'id='usernamee' class='form-control' required>

          </div>

          <div class='infodiv1'>
            <p class='labelings'>Your Mobile Number</p>
            <input type='tel' name='VictimNumber' value='$SimCardNumber' id='yourNumber' class='form-control' placeholder='' required>

          </div>

          <div class='infodiv1'>
            <p class='labelings'>Mobile Number to be reported</p>
            <input type='tel' name='ReportedNumber' value='' id='reportedMobilenumber' class='form-control' placeholder='Enter number that need to be reported here' required>

          </div>
            <button type='submit' name='reportbutton' class='send-btn'>Send</button>
        <!-- </form> -->


      </div>
      <div class='col-md-6 textclass'>
        <!-- TEXTAREA COLUMN 2 -->

          <div class='infodiv1'>
            <p class='labelings'>Remarks</p>
            <textarea id='textArea' class='form-control' name='Remarks' rows='9' cols='80' required></textarea>
          </div>

            <button type='submit' name='submit' class='ss-btn upload-btn-wrapper'>
              <input type='file' name='file'>Submit Screenshot of Message</button>                       <!-- SUBMIT BUTTON FOR SCREENSHOT -->

        <!-- </form> -->
        </div>

        </form>

    </div>
    ";
    $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=InvalidFormat") == true){
        echo "<p class= 'errormessage' style='color:#FF0000'> Incorrect Phone Number Format. please use +63 format and enter phone number only</p>";
    }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=InvalidFormat2") == true){
        echo "<p class= 'errormessage' style='color:#FF0000'> Invalid characters detected. enter numbers only!</p>";
    }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imageempty") == true){
        echo "<p class= 'errormessage' style='color:#FF0000'> No image detected. submit a screenshot of your conversation with the perpetrator to validate your report</p>";
    }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imagedatabaseerror") == true){
        echo "<p class= 'errormessage' style='color:#FF0000'> a problem encounter while trying to communicate with the server. try again later </p>";
    }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=uploaderror") == true){
        echo "<p class= 'errormessage' style='color:#FF0000'> unable to send the report to the server. please try again later.</p>";
    }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imagelarge") == true){
        echo "<p class= 'errormessage' style='color:#FF0000'> Error occur while initializing: size of the image is too large</p>";
    }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imageerror") == true){
        echo "<p class= 'errormessage' style='color:#FF0000'> There is an error with your image. either the file is corrupted or distorted. please make another image</p>";
    }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imageformaterror") == true){
        echo "<p class= 'errormessage' style='color:#FF0000'> There is a problem with your image. use .Jpg, .Jpeg, or .Png only</p>";
    }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=numberlength") == true){
        echo "<p class= 'errormessage' style='color:#FF0000'> There is an error in the Mobile Number you want to report. make sure the digits are correct</p>";
    }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=success") == true){
        echo "<p class= 'errormessage' style='color:#008000'>your report has been sent to the server</p>";
    };
  ;
  } else {

//REPORT PAGE
    echo "
    <form class='' id='form' action='UserprofileBackEnd/Back_End_User_Profile.php' method='POST'>
    <div class='row'>

      <div class='col-md-4 infocol1'>
        <!-- INFO COLUMN 1 -->

        <div class='infodiv'>
          <p class='labelings'>Name</p>
          <p class='information'>$FirstName $LastName $MiddleName $Suffix</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Gender</p>
          <p class='information'>$Gender</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Birthdate</p>
          <p class='information'>$Birthdate</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Address</p>
          <p class='information'>$Address</p>
        </div>



        <div class='infodiv'>
          <p class='labelings'>Nationality</p>
          <p class='information'>$Nationality</p>
        </div>

      </div>

      <div class='col-md-4 infocol2'>
        <!-- INFO COLUMN 2 -->
        <div class='infodiv'>
          <p class='labelings'>Sim Card Number</p>
          <p class='information'>$SimCardNumber</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Type of User</p>
          <p class='information'>$TypeofUser</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Date of Registration</p>
          <p class='information'>$DateofRegist</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Time of Registration</p>
          <p class='information'>$TimeofReg</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Registration Site</p>
          <p class='information'>$RegSite</p>
        </div>
      </div>

      <div class='col-md-4 infocol3'>
        <div class='infodiv'>
          <p class='labelings'>Sim Card</p>
          <p class='information'>$SimCard</p>
        </div>
      </div>
    </div>
    </form>";
  }
  ?>

</div>
  </body>
</html>
