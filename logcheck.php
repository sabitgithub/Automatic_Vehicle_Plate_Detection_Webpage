<?php
	
error_reporting(0);

	session_start();
	
	if(isset($_POST['Login'])){

		$userid = $_POST['userid'];
		$password = $_POST['password'];
		

		if($userid == "" || $password == ""){

			//echo "invalid submission";
			header("location: index.php?status=nullvalue");

		}else{

			$conn = mysqli_connect('', 'root', '', 'ug_project');
			$isvalid = "";
			
			
			$sqlcheck = " SELECT * FROM `login_user` WHERE `user_id` = '$userid' and `password` = '$password'";
			$result1 = mysqli_query($conn,$sqlcheck);
			if (mysqli_num_rows($result1)==0)
			
			{
				header("location: index.php?status=invalid_user!!");
			}
			else
			{
				$isvalid = "validuser";
				while($row = mysqli_fetch_assoc($result1))
					{
		
					$_SESSION['pc_id'] =  $row['pc_id'];
					
					$_SESSION['password'] =  $row['password'];
					$_SESSION['type'] =  $row['type'];
					$id = $row['id'];	
					}
			}
			}
			
			if ($isvalid == "validuser")
			{
							$_SESSION['userid'] = $userid;
							
						if (($_SESSION['type']) == "admin")
						{
							header("location:./admin_panel.php");
							//echo"Welcome!Sir"; echo "<br>";
							//echo $_SESSION['pc_id'];
						}
						if (($_SESSION['type']) == "security")
						{
							header("location:./userview.php");
							//echo"Welcome!Sir"; echo "<br>";
							//echo $_SESSION['pc_id'];
						}
						
						
					
						
			}

			mysqli_close($conn);

		}
		else 
		{
			header("location: index.php?status=invalid_Request");
		}
?>