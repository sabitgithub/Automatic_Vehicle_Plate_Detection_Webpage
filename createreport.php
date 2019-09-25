<?php
	error_reporting(0);
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('headerimg.jpg',10,6,193,50);
    $this->Ln(40);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    //$this->Cell(30,10,'Automatic Vehicle Plate Detection for Fast Parking',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
	
	if (isset($_POST['submit']))
	{
	
			$reportmethod = trim($_POST['reportmethod']);


			if ($reportmethod == "")
			{
				header("location:parkingreport.php?select_method");
			}
			else
			{

			$pdf = new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();

			$width_cell=array(40,70,40,40,40);
			$pdf->SetFont('Arial','B',12);

			$pdf->SetFillColor(193,229,252); // Background color of header 
			// Header starts /// 
			$pdf->Text(10,65, 'Report taken on:');
			$pdf->Text(50,65, date('Y-m-d H:i:s',strtotime('+4 hour',strtotime(date("Y-m-d H:i:s")))));
			$pdf->Ln(10);
			$pdf->Cell($width_cell[0],10,'   Date   ',1,0,C,true); // First header column 
			$pdf->Cell($width_cell[1],10,'  Vehicle No   ',1,0,C,true); // Second header column
			$pdf->Cell($width_cell[2],10,'  Entry Time  ',1,0,C,true); // Third header column 
			$pdf->Cell($width_cell[3],10,'  Exit Time  ',1,0,C,true); 
			$pdf->Ln();
			//// header ends ///////

			$pdf->SetFont('Arial','',14);
			$pdf->SetFillColor(235,236,236); // Background color of header 
			$fill=false; // to give alternate background fill color to rows 

			/// each record is one row  ///


			$conn = mysqli_connect('', 'root', '', 'ug_project');

						if(!$conn)
						{
							echo "DB Error: ".mysqli_connect_error();
						}
			/*echo "<br/><center>
	        <table border='1' id='table' >
	        <tr align='center'>
	          <td>Date</td>
	          <td>Vehicle No</td>
	          <td>Entry Time</td>
	          <td>Exit Time</td>
	        </tr>";*/

			if($reportmethod == "date_wise")
			{
				$startdate = $_POST['startdate'];
				$enddate = $_POST['enddate'];

			if ($startdate == "" || $enddate == "" )
			{
				header("location:parkingreport.php?select_start_or_enddate");
			}
			else
			{     
        $vehicle_info_check = " SELECT * FROM `parking_info` WHERE `opt_date` >= '$startdate' AND `opt_date` <= '$enddate' ";
          $result5 = mysqli_query($conn,$vehicle_info_check);
          while($row5 = mysqli_fetch_assoc($result5))
          {
               
      /*echo "<tr>
          <td><center>".$row5['opt_date']."</center> </td>
          <td><center>".$row5['vehicle_no']."</center> </td>
          <td><center>".$row5['entry_time']."</center> </td>
          <td><center>".$row5['exit_time']."</center> </td>
         
        </tr>";

    }
    echo "</table>
        </center>";*/

$pdf->Cell($width_cell[0],10,$row5['opt_date'],1,0,C,$fill);
$pdf->Cell($width_cell[1],10,$row5['vehicle_no'],1,0,L,$fill);
$pdf->Cell($width_cell[2],10,$row5['entry_time'],1,0,C,$fill);
$pdf->Cell($width_cell[3],10,$row5['exit_time'],1,0,C,$fill);
$fill = !$fill; // to give alternate background fill  color to rows
$pdf->Ln();
}
$date_time=date('Y-m-d H:i:s',strtotime('+4 hour',strtotime(date("Y-m-d H:i:s"))));
		$splitTimeStampfromDate = explode(" ",$date_time);
		$time_fromdate = $splitTimeStampfromDate[1];
		$splitTimeStamp = explode(":",$time_fromdate);
		$time_hr = $splitTimeStamp[0];
		$time_min = $splitTimeStamp[1];
		$time_sec = $splitTimeStamp[2];
		$total_time=$time_hr."_".$time_min."_".$time_sec;
		//$filename="reportof".date('Y-m-d').".pdf";
		$filename="Date_wise_reportTaken_Date".date('Y-m-d')."Time_".$total_time.".pdf";
		$pdf->Output($filename,'F');
		$pdf->Output();
			}
		}

			if($reportmethod == "time_wise")
			{
				$starttime = trim($_POST['starttime']);
				$endtime = trim($_POST['endtime']);

				if ($starttime == "" || $endtime == "" )
			{
				header("location:parkingreport.php?select_start_or_endTIME");
			}
			else
			{

			}



			}

			if($reportmethod == "aiubid_wise")
			{
				$aiub_id = trim($_POST['aiub_id']);

				if ($aiub_id == "")
			{
				header("location:parkingreport.php?aiub_id_NULL");
			}
			else
			{
				$vehicle_info_aiubid = " SELECT * FROM `vehicle_info` WHERE `aiub_id` = '$aiub_id' ";
          $vehicle_info_aiubid_result = mysqli_query($conn,$vehicle_info_aiubid);
          while($row5 = mysqli_fetch_assoc($vehicle_info_aiubid_result))
          {
          	$aiubid_vehicle_no=$row5['vehicle_no'];
          }
 	$vehicle_info_check = " SELECT * FROM `parking_info` WHERE `vehicle_no` = '$aiubid_vehicle_no' ";
          $result5 = mysqli_query($conn,$vehicle_info_check);
          while($row5 = mysqli_fetch_assoc($result5))
          {
               
     /* echo "<tr>
          <td><center>".$row5['opt_date']."</center> </td>
          <td><center>".$row5['vehicle_no']."</center> </td>
          <td><center>".$row5['entry_time']."</center> </td>
          <td><center>".$row5['exit_time']."</center> </td>
         
        </tr>";

    }
    echo "</table>
        </center>";*/
  

$pdf->Cell($width_cell[0],10,$row5['opt_date'],1,0,C,$fill);
$pdf->Cell($width_cell[1],10,$row5['vehicle_no'],1,0,L,$fill);
$pdf->Cell($width_cell[2],10,$row5['entry_time'],1,0,C,$fill);
$pdf->Cell($width_cell[3],10,$row5['exit_time'],1,0,C,$fill);
$fill = !$fill; // to give alternate background fill  color to rows
$pdf->Ln();

}
$date_time=date('Y-m-d H:i:s',strtotime('+4 hour',strtotime(date("Y-m-d H:i:s"))));
		$splitTimeStampfromDate = explode(" ",$date_time);
		$time_fromdate = $splitTimeStampfromDate[1];
		$splitTimeStamp = explode(":",$time_fromdate);
		$time_hr = $splitTimeStamp[0];
		$time_min = $splitTimeStamp[1];
		$time_sec = $splitTimeStamp[2];
		$total_time=$time_hr."_".$time_min."_".$time_sec;
		//$filename="reportof".date('Y-m-d').".pdf";
		$filename="ID_wise_reportTaken_Date".date('Y-m-d')."Time_".$total_time.".pdf";
		$pdf->Output($filename,'F');
		$pdf->Output();
			}
		}

			if($reportmethod == "vehcileno_wise")
			{
				$vehicle_no_cityname=$_POST['vehicle_no_cityname'];
				$vehicle_no_class = $_POST['vehicle_no_class'];
				$vehicle_reg_no = $_POST['vehicle_reg_no'];
				$vehcle_number = $_POST['vehicle_no'];
				$vehcle_number_full= $vehicle_no_cityname." ".$vehicle_no_class." ".$vehicle_reg_no."-".$vehcle_number;

				if ($vehicle_no_cityname == "" || $vehicle_no_class == "" || $vehicle_reg_no == "" || $vehcle_number == ""  )
			{
				header("location:parkingreport.php?Vehicle_wise_all_information_invalid");
			}
			else
			{


				$vehicle_info_check = " SELECT * FROM `parking_info` WHERE `vehicle_no` = '$vehcle_number_full' ";
          $result5 = mysqli_query($conn,$vehicle_info_check);
          while($row5 = mysqli_fetch_assoc($result5))
          {
               
/*      echo "<tr>
          <td><center>".$row5['opt_date']."</center> </td>
          <td><center>".$row5['vehicle_no']."</center> </td>
          <td><center>".$row5['entry_time']."</center> </td>
          <td><center>".$row5['exit_time']."</center> </td>
         
        </tr>";

    }
    echo "</table>
        </center>";*/

        $pdf->Cell($width_cell[0],10,$row5['opt_date'],1,0,C,$fill);
		$pdf->Cell($width_cell[1],10,$row5['vehicle_no'],1,0,L,$fill);
		$pdf->Cell($width_cell[2],10,$row5['entry_time'],1,0,C,$fill);
		$pdf->Cell($width_cell[3],10,$row5['exit_time'],1,0,C,$fill);
		$fill = !$fill; // to give alternate background fill  color to rows
		$pdf->Ln();
		}
		$date_time=date('Y-m-d H:i:s',strtotime('+4 hour',strtotime(date("Y-m-d H:i:s"))));
		$splitTimeStampfromDate = explode(" ",$date_time);
		$time_fromdate = $splitTimeStampfromDate[1];
		$splitTimeStamp = explode(":",$time_fromdate);
		$time_hr = $splitTimeStamp[0];
		$time_min = $splitTimeStamp[1];
		$time_sec = $splitTimeStamp[2];
		$total_time=$time_hr."_".$time_min."_".$time_sec;
		//$filename="reportof".date('Y-m-d').".pdf";
		$filename="Vehicle_wise_reportTaken_Date".date('Y-m-d')."Time_".$total_time.".pdf";
		$pdf->Output($filename,'F');
		$pdf->Output();

			}				
			}
		}
	}
