<?php

  require 'connection.php';

  $sumtime = 0;

  //$_POST['thename'];
  //$_POST['themonth'];
  //$_POST['theyear'];

  $newdate = $_POST['theyear']."_".$_POST['themonth'];
  echo "<p>The date is: ".$newdate."</p>";

  $select = "SELECT * FROM clockify_API.$newdate WHERE Name LIKE '".$_POST['thename']."%' AND Tag = 'undefined';";

  echo "<p>The query is: ".$select."</p>";

  $result = mysqli_query($clock_conn, $select);

  $count = mysqli_num_rows($result);

  if($count != 0){

    echo "<table border='1'>";


    for ($i = 0; $i < $count; $i ++){

      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

      $timestr = $row['Time_Interval'];

      $partsH = explode('H', $timestr);
      $partsM = explode('M', $timestr);
      $partsS = explode('S', $timestr);

      $hours = 0;
      $mins = 0;
      $seconds = 0;

      //ONLY ONE TRUE

      if(strpos($timestr, 'H') == true && strpos($timestr, 'M') == false && strpos($timestr, 'S') == false){

        $hours =  ( (int)($partsH[0]) * 60 * 60 );
        $sumtime += ($hours+$mins+$seconds);

      }

      if(strpos($timestr, 'H') == false && strpos($timestr, 'M') == true && strpos($timestr, 'S') == false){

        $mins = ( (int)($partsM[0]) * 60 );
        $sumtime += ($hours+$mins+$seconds);


      }
      if(strpos($timestr, 'H') == false && strpos($timestr, 'M') == false && strpos($timestr, 'S') == true){

        $seconds = (int)($partsS[0]);
        $sumtime += ($hours+$mins+$seconds);

      }

      //ONLY ONE FALSE

      if(strpos($timestr, 'H') == true && strpos($timestr, 'M') == true && strpos($timestr, 'S') == false){

        $hours =  ( (int)($partsH[0]) * 60 * 60);
        $mins = ( (int)($partsH[1]) * 60) ;
        $sumtime += ($hours+$mins+$seconds);

      }
      if(strpos($timestr, 'H') == true && strpos($timestr, 'M') == false && strpos($timestr, 'S') == true){

        $hours =  ( (int)($partsH[0]) * 60 * 60 );
        $seconds = (int)($partsH[1]);
        $sumtime += ($hours+$mins+$seconds);

      }
      if(strpos($timestr, 'H') == false && strpos($timestr, 'M') == true && strpos($timestr, 'S') == true){

        $mins = ( (int)($partsM[0]) * 60 );
        $seconds = (int)($partsM[1]);
        $sumtime += ($hours+$mins+$seconds);


      }

      //ALL TRUES

      if(strpos($timestr, 'H') == true && strpos($timestr, 'M') == true && strpos($timestr, 'S') == true){

        $hours =  ( (int)($partsH[0]) * 60 * 60 );
        $mins = ( (int)($partsH[1]) * 60 );
        $seconds = (int)$partsM[1];
        $sumtime += ($hours+$mins+$seconds);

      }

      echo "
      <tr>
      <td>".$row['i_number']."</td>
      <td>".$row['Name']."</td>
      <td>".$row['User_ID']."</td>
      <td>".$row['Email']."</td>
      <td>".$row['Description']."</td>
      <td>".$row['Entry_Date']."</td>
      <td>".$row['Time_Interval']."</td>
      <td>".$row['Start_time']."</td>
      <td>".$row['End_time']."</td>
      <td>".$row['Tag']."</td>
      <td>".$row['Project']."</td>
      </tr>
      ";

    }
    echo "</table>";

    //gmdate("z H:i:s", ($sumtime));

    $finaltime = sprintf('%02d',floor($sumtime / 3600)).gmdate(":i:s", $sumtime % 3600);
    echo "<p>The total time equals: <strong>".$finaltime."</strong></p>";
    echo "<p><a href='Hours_per_month.html'>BACK</a></p>";

  }
  else{

    echo "<p>Records for this user <strong>do not exist</strong></p>";

    echo "<p><a href='Hours_per_month.html'>BACK</a></p>";

  }

  //echo "<p>The query is: ".$select."</p>";




?>
