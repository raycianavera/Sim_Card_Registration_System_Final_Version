<?php

include_once "dbh.inc.php";
session_start();


if(isset($_POST['register'])){

  $passport = $_SESSION['passportnumber'];
     $query = "SELECT * FROM foreign_passport_db WHERE passnum =  '$passport'; ";
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
         $passnum_nsonum = $row['passnum'];
         $nationality = $row['nationality'];




       }



     // DATA FROM REGIS
     $address = $_POST['address'];
     $simcard = $_POST['simcard'];
     $simnum = $_POST['simnum'];
     $regisite = $_POST['regisite'];
     $dateofregis = date('Y-m-d', strtotime($_POST['dateofregis']));
     $time  = date('G')."-".date('i')."-".date('s');


       // fingerprint image
       $file = $_FILES['file'];

       // getting file details
       $fileName       =$file["name"];
       $fileType       =$file["type"];
       $fileTempName   =$file["tmp_name"];
       $fileError      =$file["error"];
       $fileSize       =$file["size"];

       $allowed        = array("jpg","jpeg","png","bmp");
       $fileExt        = explode(".",$fileName);
       $fileActualExt  = strtolower(end($fileExt));



       $Name_FingerprintImage       = "Fingerprint-".$lastN."-".$firstN."D-".$dateofregis."_T-".$time;
       $Fingerprint_ImageFullName   = $Name_FingerprintImage.".".$fileActualExt;


         $sqlnso = "SELECT simnum FROM registered_simusers_db WHERE simnum = $simnum";
         $result = mysqli_query($conn, $sqlnso);
         $resultsCheck = mysqli_num_rows($result);
         if($resultsCheck == 1){
       echo "<script> window.location.href='register-users-foreign.php?error=simnum-already-exist'; </script>";
       // header("Location: ../seller-register-foreign.html?error=simnum-already-exist");
       // echo "<h2>Error</h2>";
     }

     else {
       $sql = "INSERT INTO registered_simusers_db (lastname, firstname, midname, suffix, dateofbirth, gender, passnum_nsonum, address,nationality,simcard, simnum,regisite,dateofregis,time,fingerprint_File_Format, fingerprint_File_Name)
       VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
       // PREPARED STATEMENT
       $stmt = mysqli_stmt_init($conn);
       // PREPARE THE PREPARE STATEMENT
       if(!mysqli_stmt_prepare($stmt, $sql)){
         echo "SQL statement failed";
       }else{
         mysqli_stmt_bind_param($stmt,"ssssssssssssssss",  $lastN, $firstN, $midN, $sfx, $dob, $gndr, $passnum_nsonum, $address,$nationality,$simcard, $simnum, $regisite, $dateofregis,$time, $Fingerprint_ImageFullName , $Name_FingerprintImage );
         // RUN PARAMETER INDSIDE DATABASE
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
         $fileDestination = '../Fingerprint_Registered_User_Database/'.$Fingerprint_ImageFullName; //kung saan move yung fingerprint sa folder. dapat same yung folder name. ikaw na bahala
         move_uploaded_file($fileTempName,$fileDestination);  //imomove na yung file to that folder
         echo "<script> window.location.href='../register-users-foreign.php?signup=success'; </script>";
         // header("Location: register-users.php?signup=success");
       }
     }
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
   }
 }
