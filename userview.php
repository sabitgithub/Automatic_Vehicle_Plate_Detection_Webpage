<?php
error_reporting(0);
session_start();
clearstatcache();

if(isset($_SESSION['userid']))
{
$userid = $_SESSION['userid'];
$imgdir="http://localhost:85/ug_final/" ;
$conn = mysqli_connect('', 'root', '', 'ug_project');
$vehicle_registration_status="";
$vehicle_exp_status="";
$today_date= date('Y-m-d');
$current_time = date("H:i:s" ,strtotime('+4 hour',strtotime(date("Y-m-d H:i:s"))));
$current_time2 = date("H:i:s" ,strtotime('+8 hour',strtotime(date("Y-m-d H:i:s"))));
//echo "Time:: ".$current_time;
//$today_date= "2019-04-02";
$prk_msg="";
$msg="";
$vehicle_cloud_cityname="";
$vehicle_cloud_classname="";
$vehicle_cloud_no="";
$gate_status="";
$register_status="";
$vehicle_cloud_datalink="";
$opengate_valid="";


    //fatching data from cloud::

    $vehicle_cloud_link="SELECT * FROM `thinkspeak_cloud`";
    $cloud_link_result= mysqli_query($conn,$vehicle_cloud_link);
    while ($cloud_link_result_row = mysqli_fetch_assoc($cloud_link_result)) 
    { 
      $vehicle_cloud_datalink_cityname=  $cloud_link_result_row['vehicle_cityname_cloud'];
      $vehicle_cloud_datalink_classname=  $cloud_link_result_row['vehicle_classname_cloud'];
      $vehicle_cloud_datalink_no=  $cloud_link_result_row['vehicle_no_cloud'];
      $vehicle_cloud_datalink_gate_status=  $cloud_link_result_row['vehicle_gate_status_cloud'];
      $vehicle_cloud_datalink_registration_status=  $cloud_link_result_row['vehicle_registration_status_cloud'];
    }

          $jsondata_cloud_cityname = file_get_contents($vehicle_cloud_datalink_cityname);
          $arr_cloud_cityname = json_decode($jsondata_cloud_cityname, true);
          $vehicle_cloud_cityname = trim($arr_cloud_cityname[field1]);

          $jsondata_cloud_class = file_get_contents($vehicle_cloud_datalink_classname);
          $arr_cloud_class = json_decode($jsondata_cloud_class, true);
          $vehicle_cloud_class_database = trim($arr_cloud_class[field2]);

          $jsondata_cloud_no = file_get_contents($vehicle_cloud_datalink_no);
          $arr_cloud_no = json_decode($jsondata_cloud_no, true);
          $vehicle_cloud_vehicle_no = trim($arr_cloud_no[field3]);

          $jsondata_cloud_gate = file_get_contents($vehicle_cloud_datalink_gate_status);
          $arr_cloud_gate = json_decode($jsondata_cloud_gate, true);
          $vehicle_cloud_gate = trim($arr_cloud_gate[field4]);

          $jsondata_cloud_registration = file_get_contents($vehicle_cloud_datalink_registration_status);
          $arr_cloud_registration_status = json_decode($jsondata_cloud_registration, true);
          $vehicle_cloud_registration_status = trim($arr_cloud_registration_status[field5]);

          $final_cloud_data= trim($vehicle_cloud_cityname.' '.$vehicle_cloud_class_database.' '.$vehicle_cloud_vehicle_no);
          //echo "cloud result: ".$final_cloud_data;

    $checK_vehicle_cloud="SELECT * FROM `vehicle_info` WHERE `vehicle_no` = '$final_cloud_data'";
    $cloud_check_result= mysqli_query($conn,$checK_vehicle_cloud);
    $cloud_result_count= mysqli_num_rows($cloud_check_result);
    //echo"check match result: ".$cloud_result_count;
    if($cloud_result_count == "" )
    {
      $msg="invalidcar";

    }
  else
  {
    while ($vehicle_row = mysqli_fetch_assoc($cloud_check_result)) 
    { 
      $vehicle_registration_status=  $vehicle_row['reg_date'];
      $vehicle_exp_status=  $vehicle_row['reg_exp_date'];
           $id =  $row2['id'];
          $aiub_id =  $vehicle_row['aiub_id'];
          $vehicle_no =  $vehicle_row['vehicle_no'];
          $reg_date = $vehicle_row['reg_date'];
          $reg_exp_date = $vehicle_row['reg_exp_date'];
          $bluebook_path =  $vehicle_row['bluebook_path'];
          $driving_lic_path =  $vehicle_row['driving_lic_path'];
          $driver_img_path = $vehicle_row['driver_img_path'];
           $current_img = $vehicle_row['current_img']; 

    }
    if($vehicle_exp_status == $today_date) //exists or not
    {
      $msg="registration date expired";
    }

    else
    {
      $count_vehicle="SELECT *FROM 'parking_info'WHERE `opt_date` = '$today_date'";
      $count_vehicle_query= mysqli_query($conn,$count_vehicle);
      $count_parking_cars= mysqli_num_rows($count_vehicle_query);
      if ($count_parking_cars == 0/*) && ($count_parking_cars < 50)*/)
      {
        //Send get status to the cloud
        $msg="Valid car";
        $prk_msg="Please Park your car in position";
        $opengate_valid="valid";
      
         $parking_data_store= " INSERT INTO `parking_info`(`id`, `opt_date`, `vehicle_no`, `entry_time`, `exit_time`, `gate_status`, `user_id`) VALUES (NULL, '$today_date', '$final_cloud_data', '$current_time', '$current_time2', 'off', '$userid'); ";

           $parking_data_store_result = mysqli_query($conn, $parking_data_store);
     }
      else
      {
        $prk_msg="Parking Slot Not avilable";
      }

    }

    }      
      
      $usercheck = " SELECT * FROM `login_user` WHERE `user_id` = '$userid'";
      $result1 = mysqli_query($conn,$usercheck);
        
        while($row1 = mysqli_fetch_assoc($result1))
          {
    
          $id =  $row1['id'];
          $pc_id =  $row1['pc_id'];
          $user_id =  $row1['user_id'];
          $password = $row1['password'];
          $type = $row1['type'];
           
          }

        $parking_status = " SELECT * FROM `parking_info` WHERE `vehicle_no` = '$final_cloud_data'";
        $result3 = mysqli_query($conn,$parking_status);
        
        while($row3 = mysqli_fetch_assoc($result3))
          {
    
          $id =  $row3['id'];
          $opt_date =  $row3['opt_date'];
          $vehicle_id =  $row3['vehicle_id'];
          $entry_time = $row3['entry_time'];
          $exit_time = $row3['exit_time'];
          $gate_status =  $row3['gate_status'];
          $user_id = $row3['user_id'];           
          }



          

?>
<!DOCTYPE html>
<html>
<head>
  <title>
    Automatic Vehicle Plate Detection
  </title>
  <center><?php include_once "userview_header.php";?></center>

<style>
  
  {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column1 {
    float: left;
    width: 20%;
    padding: 10px;
    height: 100%;; /* Should be removed. Only for demonstration */
}
.column2 {
    float: left;
    width: 80%;
    padding: 10px;
    height: 100%;; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

.btn {
  position:fixed;
   right:10px;
   top:40px;
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: 70px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.btn span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.btn span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.btn:hover span {
  padding-right: 25px;
}

.btn:hover span:after {
  opacity: 1;
  right: 0;
}

</style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<body>
  <form action="" name="cloudvalidform" >
     <script>
          $(document).ready(function(){
                      $.ajax({
                         type:'post',
                         url:'http://api.thingspeak.com/update?api_key=BX4GOOLVFB42NBFS&field1=<?=$vehicle_cloud_cityname?>&field2=<?=$vehicle_cloud_class_database?>&field3=<?=$vehicle_cloud_vehicle_no?>&field4=open&field5=valid',
                         success:function(res)
                         { 
                          //alert('success');
                        }
                   });
                  });

            </script>
    </form> 


  <div class="row">

  <div class="column1" style="background-color:#ffffff;">
    <?php
    if($msg != "invalidcar") {

        ?>

    <a href="<?php echo "http://localhost:85/ug_final/img/".$current_img;?>" target="_blank">
    <img src="<?php echo "http://localhost:85/ug_final/img/".$current_img;?>" height="350" width="250"> </a>
    <br> <br>
    AIUB ID: <?php echo "$aiub_id"; ?>
    <br> <hr>
    Vehicle No: <?php echo "$vehicle_no"; ?>
    <br> <hr>
   Registration Date: <?php echo "$reg_date"; ?>
    <br> <hr>
    Registration Exp.: <?php echo "$reg_exp_date"; ?>

    <?php 
            }
            else
              echo" <h1> Invalid Vehicle </h1> ";
     ?>
        
  </div>

  <div class="column2" style="background-color:#b3daff;">
    <h4> Server Time:  <?php echo date('d-m-Y H:i',strtotime('+4 hour',strtotime(date("d-m-Y H:i"))))  ?>  </h4>
    <!-- <h4> <?php echo "$msg";  ?></h4>   -->
    <h4> <?php echo "$prk_msg";  ?> </h4>
    <h1> Automatic Vehicle Plate Detection: </h1> 
    <button class="btn" style="vertical-align:middle" onclick="location.href='logout.php';" > <span> Log OUT </span> </button>    
      <h3> Current Vehicle Plate Documnets: </h3>

      <?php 

       if($msg != "invalidcar") { 
        ?>

    
          
       
      <table border='1' id='table' >
     <tr> 
     <td> <a href="<?php echo $imgdir.$driver_img_path;?>" target="_blank"> <img src="<?php echo $imgdir.$driver_img_path;?>" height="250" width="150"> </a> </td>
      <td> <a href="<?php echo $imgdir.$driving_lic_path;?>" target="_blank"> <img src="<?php echo $imgdir.$driving_lic_path;?>" height="250" width="150"></a> </td>
      <td> <a href="<?php echo $imgdir.$bluebook_path;?>" target="_blank"> <img src="<?php echo $imgdir.$bluebook_path;?>" height="250" width="150"> </a> </td>
     </tr>
     <tr> 
      <td> <center> <h5> Image </h5> </center> </td>
      <td> <center> <h5> Driving Licence </h5> </center> </td>
      <td> <center>  <h5> Vehicle Bluebook </h5> </center> </td>
     </tr> 
     </table>

     
     
     <?php 
            }
            else
              echo" <h1> Please Contact to the ADMIN!! </h1> ";
     ?>
     <hr>
    <?php 
    
    echo "<br/><center>
        <table border='1' id='table' >
        <tr align='center'>
          <td>Date</td>
          <td>Vehicle No</td>
          <td>Entry Time</td>
          <td>Exit Time</td>
          <td>Gate Status</td>
          <td>User ID <br> </td>
        </tr>";
    
      $parking_list = " SELECT * FROM `parking_info` ";
      $result4 = mysqli_query($conn,$parking_list);

    while($row4= mysqli_fetch_assoc($result4))
    {
        
               
      echo "<tr>
          <td><center>".$row4['opt_date']."</center> </td>
          <td><center>".$row4['vehicle_no']."</center> </td>
          <td><center>".$row4['entry_time']."</center> </td>
          <td><center>".$row4['exit_time']."</center> </td>
          <td><center>".$row4['gate_status']."</center> </td>
          <td><center>".$row4['user_id']."</center> </td>
         
        </tr>";

  }
        
    echo "</table>
        </center>";
    
    
  

?>
  </div>
</div>


</body>
</html>

<?php
} 

else
{
  if($opengate_valid=="valid"){
        /*echo" <script>
          $(document).ready(function(){
                      $.ajax({
                         type:'post',
                         url:clouddata.php,
                         success:function(res)
                         { 
                          alert('success');
                        }
                   });
                  });

            </script>";*/

            header("clouddata.php");
          }


  header("location:Login.php?invalid_user");
}
?>
