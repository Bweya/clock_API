<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

      <?php

        require 'connection.php';

        //echo "<p>Date is: ".$_POST['dAte1']."</p>";
        $subdate = substr($_POST['dAte1'], 0, 7);

        //echo "<p>Month and year is: ".$subdate ."</p>";
        $newdate = str_replace("-","_", $subdate);

        echo "<p>Replaced date string is: ".$newdate."</p>";

        $query = "
        CREATE TABLE $newdate(
          i_number VARCHAR(255) NULL,
          Name VARCHAR(255) NULL,
          User_ID VARCHAR(255) NULL,
          Email VARCHAR(255) NULL,
          Desription VARCHAR(255) NULL,
          Entry_Date date NULL,
          Time_Interval VARCHAR(255) NULL,
          Start_time VARCHAR(255) NULL,
          End_time VARCHAR(255) NULL,
          Tag VARCHAR(255) NULL,
          Project VARCHAR(255) NULL
        );

        ";

        $result = mysqli_query($clock_conn, $query);

        if($result){

            $count = $_POST['dcount'];

            for($i = 1; $i < $count; $i++){

              $des = mysqli_real_escape_string($clock_conn, $_POST["dEscription$i"]);
              $start_hour = mysqli_real_escape_string($clock_conn, $_POST["startH$i"]);
              $end_hour = mysqli_real_escape_string($clock_conn, $_POST["endH$i"]);
              $projects = mysqli_real_escape_string($clock_conn, $_POST["project$i"]);

              $insert = "INSERT INTO clockify_API.$newdate VALUES(
                '".$i."',
                '".$_POST["dName$i"]."',
                '".$_POST["dIDs$i"]."',
                '".$_POST["dEmail$i"]."',
                '".$des."',
                '".$_POST["dAte$i"]."',
                '".$_POST["dUration$i"]."',
                '".$start_hour."',
                '".$end_hour."',
                '".$_POST["tAgz$i"]."',
                '".$projects."'
              );";
              mysqli_query($clock_conn, $insert);
              echo "<p>".$i.") Name: ".$_POST["dName$i"]."  ".$_POST["dUration$i"]."</p>";


            }
            echo "<p><strong>$newdate</strong> details have been backed up <strong>successfully</strong></p>";

      }

      else{

        echo "<p><strong>$newdate</strong> back up already exists</strong></p>";

      }




      ?>

  </body>
</html>
