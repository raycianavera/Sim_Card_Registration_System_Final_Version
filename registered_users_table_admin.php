<?php
require 'includes/dbh.inc.php';
$sql = "SELECT * FROM registered_simusers_db ORDER BY lastname ASC";
$result = mysqli_query($conn, $sql);
session_start();
$AdminLName = $_SESSION['AdminLastName'] ;
$AdminFName = $_SESSION['AdminFirstName'];
$AdminEmail = $_SESSION['AdminEmail'];
$AdminPass  = $_SESSION['AdminPassword'];
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
  <link rel="stylesheet" href="styles/adminstyle.css">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>

</head>
  <body>
    <!-- NAVBAR PART -->
    <header>

      <nav class="navbar navbar-expand-lg">
        <a class="div1 navbar-brand" href="admininbox.php">
            <img src="images/logo.png" width="30" height="32" class="d-inline-block align-top" alt="">
            <span class="brandname">SimCardRegistrationSystem</span>
          </a>

        <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">


            <ul class='navbar-nav'>
              <li class='nav-item'>
                <a class='nav-link selected' href='registered_users_table_admin.php'>Users</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='admininbox.php'>Inbox</a>
              </li>

              <li class="nav-item">
                <form class="form-btnn" action="Logout/logoutprocess_Admin.php" method="POST">
                  <button type="submit" name="btn-primary" class="nav-link logbtn">Logout</button>
                </form>
              </li>
            </ul>



          <form class="form-inline" action="includes/search_registered.php" method="POST">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="input-search">
            <button class="log-button search-btn my-2 my-sm-0" type="submit" name="submit-search">Search</button>
          </form>

        </div>
      </nav>
    </header>

<!-- INBOX PART -->

<!--
    <div class="row header">
      <div class="title-cont">
      <div class="col-md-6">
        <h4>Administrator: <?php echo "$AdminFName $AdminLName";?></h4>
      </div>
        <div class="col-md-6">
        <h4 class="rep-message">Registered SIM Card Users</h4>
        </div>

    </div>

    </div> -->
    <div class="row admin-row" style="background-color: white;">
      <div class="col-md-6" style="padding-left: 2rem;">
        <p class="header text-truncate">Administrator: <?php echo "$AdminFName $AdminLName";?></p>
      </div>

      <div class="col-md-6" style="padding-left: 2rem;">
        <p class="header text-truncate">Registered SIM Card Users</p>

      </div>

    </div>
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="f-column text-truncate" scope="col" >Last Name</th>
          <th class="f-column text-truncate" scope="col" >First Name</th>
          <th class="f-column text-truncate" scope="col" >Middle Name</th>
          <th class="f-column text-truncate" scope="col" >Suffix</th>
          <th class="f-column text-truncate" scope="col" >Birthdate</th>
          <th class="f-column text-truncate" scope="col" >Gender</th>
          <th class="f-column text-truncate" scope="col" >NSO or Passport #</th>
          <th class="f-column text-truncate" scope="col" >Address</th>
          <th class="f-column text-truncate" scope="col" >Nationality</th>
          <th class="f-column text-truncate" scope="col" >SIM User Type</th>
          <th class="f-column text-truncate" scope="col" >SIM Card #</th>
          <th class="f-column text-truncate" scope="col" >Registration Site</th>
          <th class="f-column text-truncate" scope="col" >Registration Date</th>
          <th class="f-column text-truncate" scope="col" >Registration Time</th>

        </tr>
      </thead>
      <tbody>

        <?php
              while($row = mysqli_fetch_assoc($result)):
        ?>

        <tr class="canHov">

          <th scope="row" class="text-truncate"><?php echo $row['lastname']; ?></th>
          <td class="text-truncate"><?php echo $row['firstname']; ?></td>
          <td class="text-truncate"><?php echo $row['midname']; ?></td>
          <td class="text-truncate"><?php echo $row['suffix']; ?></td>
          <td class="text-truncate"><?php echo $row['dateofbirth']; ?></td>
          <td class="text-truncate"><?php echo $row['gender']; ?></td>
          <td class="text-truncate"><?php echo $row['passnum_nsonum']; ?></td>
          <td class="text-truncate"><?php echo $row['address']; ?></td>
          <td class="text-truncate"><?php echo $row['nationality']; ?></td>
          <td class="text-truncate"><?php echo $row['simcard']; ?></td>
          <td class="text-truncate"><?php echo $row['simnum']; ?></td>
          <td class="text-truncate"><?php echo $row['regisite']; ?></td>
          <td class="text-truncate"><?php echo $row['dateofregis']; ?></td>
          <td class="text-truncate"><?php echo $row['time']; ?></td>

        </tr>

      <?php endwhile; ?>


      </tbody>
    </table>

  </div>


</body>

</html>
