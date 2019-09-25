<?php
	error_reporting(0);
	
	if (isset($_POST['submit']))
	{
	
			$aiub_id=trim($_POST['aiub_id']);
			$vehicle_no_cityname=$_POST['vehicle_no_cityname'];
			$vehicle_no_class = trim($_POST['vehicle_no_class']);
			$vehicle_reg_no = trim($_POST['vehicle_reg_no']);
			$vehicle_no=trim($_POST['vehicle_no']);
			$reg_date=trim($_POST['reg_date']);
			$reg_exp_date=trim($_POST['expdate']);
			$vehcile_number= $vehicle_no_cityname." ".$vehicle_no_class." ".$vehicle_reg_no."-".$vehicle_no; 


			

			if ($aiub_id == "" || $vehicle_no =="" || $vehcile_number == "" )
			{
				
				header("location:admin_panel.php?null_value_not_accepted");
			}
			else
			{
			
				$filedir = "upload_document/";

				$filepath_bluebook_img = $filedir.$_FILES["bluebook_img"]["name"];
				move_uploaded_file($_FILES['bluebook_img']['tmp_name'], $filepath_bluebook_img);

				$filepath_driving_img = $filedir.$_FILES["driving_img"]["name"];
				move_uploaded_file($_FILES['driving_img']['tmp_name'], $filepath_driving_img);

				$filepath_driver_img = $filedir.$_FILES["driver_img"]["name"];
				move_uploaded_file($_FILES['driver_img']['tmp_name'], $filepath_driver_img);

				$filepath_vehicle_img = $filedir.$_FILES["vehicle_img"]["name"];
				move_uploaded_file($_FILES['vehicle_img']['tmp_name'], $filepath_vehicle_img);

				$filepath_vehicle_img2 = "img/".$_FILES["vehicle_img"]["name"];
				move_uploaded_file($_FILES['vehicle_img']['tmp_name'], $filepath_vehicle_img2);
								
					

					$conn = mysqli_connect('', 'root', '', 'ug_project');

						if(!$conn)
						{
							echo "DB Error: ".mysqli_connect_error();
						}
						else
						{
							
							
						$sql1= " INSERT INTO `vehicle_info` (`id`, `aiub_id`, `vehicle_no`, `reg_date`, `reg_exp_date`, `bluebook_path`, `driving_lic_path`, `driver_img_path`,`current_img`) VALUES (NULL, '$aiub_id', '$vehcile_number', '$reg_date', '$reg_exp_date', '$filepath_bluebook_img', '$filepath_driving_img', '$filepath_driver_img', '$filepath_vehicle_img'); ";

							$result1 = mysqli_query($conn, $sql1);
							

							/*$sql2 = "INSERT INTO `patient`(`id`, `phone`, `name`, `email`, `blood_group`, `age`, `weight`, `heart_dis`, `blood_pulse`, `Temp`, `majority`, `medicine`, `photo`, `device_id`) VALUES ('','$phone','$full_name','$email','$blood_group','$age','$weight','$heart_disease','$blood_pul_rate','','$majority','$medicine','$filepath','$dev_id')";
							$result2 = mysqli_query($conn, $sql2);*/
							mysqli_close($conn);
							header("location: admin_panel.php?Status=vehcile_registration_confirmed");
						
							
						
										
						}
					}
				
				
			} //else ending
			
	 //isset ending
	
	else
	{
		header("location:index.php?invalid_request");
	}
	