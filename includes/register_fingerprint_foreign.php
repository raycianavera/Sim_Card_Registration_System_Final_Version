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
     date_default_timezone_set('Asia/Manila');
     $time  = date('G').":".date('i').":".date('s');
     $timeImg  = date('G')."-".date('i')."-".date('s');



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



       $Name_FingerprintImage       = "Fingerprint-".$lastN."-".$firstN."D-".$dateofregis."_T-".$timeImg;
       $Fingerprint_ImageFullName   = $Name_FingerprintImage.".".$fileActualExt;


         $sqlnso = "SELECT simnum FROM registered_simusers_db WHERE simnum = $simnum";
         $result = mysqli_query($conn, $sqlnso);
         $resultsCheck = mysqli_num_rows($result);
         if($resultsCheck == 1){
       header("Location: ../register-users-foreign.php?error=simnum-already-exist");
       // echo "<script> window.location.href='../register-users-foreign.php?error=simnum-already-exist'; </script>";
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
         $countnumber = strlen($simnum);
         if($countnumber != 13){
             header("Location: ../register-users-foreign.php?error=incorrectNum"); //error for wrong count
             exit();
         }else{
           if(!preg_match("/[a-zA-Z +-]/",$simnum)){   //ERROR 404 for lack of + plus
               header("Location: ../register-users-foreign.php?error=missplus");
               exit();
           }else{
             $noplusnum = str_replace("+","",$simnum); //remove "+"
             if(preg_match("/^[a-zA-Z_ -]*$/", $noplusnum)){ // ERROR 404 for not being number
                   header("Location: ../register-users-foreign.php?error=wrongchars");
                   exit();
             }else{
                   mysqli_stmt_bind_param($stmt,"ssssssssssssssss",  $lastN, $firstN, $midN, $sfx, $dob, $gndr, $passnum_nsonum, $address,$nationality,$simcard, $simnum, $regisite, $dateofregis,$time, $Fingerprint_ImageFullName , $Name_FingerprintImage );
                   // RUN PARAMETER INDSIDE DATABASE
                   mysqli_stmt_execute($stmt);
                   $result = mysqli_stmt_get_result($stmt);
                   $fileDestination = '../Fingerprint_Registered_User_Database/'.$Fingerprint_ImageFullName; //kung saan move yung fingerprint sa folder. dapat same yung folder name. ikaw na bahala
                   move_uploaded_file($fileTempName,$fileDestination);  //imomove na yung file to that folder
                   // echo "<script> window.location.href='../register-users-foreign.php?signup=success'; </script>";
                   header("Location: ../register-users-foreign.php?signup=success");
             }
           }
         }
       }
     }
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
   }
 } else {
    header("Location: ../register-users-foreign.php?nsonum=.$nso.&button=no-result");
}
