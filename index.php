
<?php
error_reporting(0);
	
	{

	}


?>



<html>
<head>
<title>  Automatic Vehicle Plate Detection </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>


<fieldset>
</br>
   <center>  <legend><b> <h2> Automatic Vehicle Plate Detection for Fast Parking/ Toll Collection/ Security </h2> </b></legend> </center>

	<form method="post" action="logcheck.php">
		<br/>


		<div class="w3-cell-row">
  <div class="w3-container w3-red w3-cell w3-cell-top">
   
    <img id="post_full_img" src="poster_img.jpg" />
  </div>
  <div class="w3-container w3-green w3-cell w3-cell-middle">
    <table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td><div id="logpg"> UserID </div> </td>
				
				<td>
			 
				<input class="w3-input w3-border" name = "userid" type="text" placeholder="UserID"  value="" />

				</td>
				<td></td>
			</tr>

		<tr><td colspan="4"><hr/></td></tr>
			<tr>
				<td>
					<div id="logpg"> Password </div> </td>
				
			
				<td>
			
					<input class="w3-input w3-border" name="password" type="password" placeholder = "Enter your valid password"></td>
				<td></td>
			</tr>
			
		</table>
		<hr/>
	 	<center>
	 	
		</br>
		<button class="w3-btn w3-blue" name="Login" value="Login" type="submit" onclick="logcheck.php">Login 
		</button>
		</center>
		<br/>
  </div>

		
	</form>
</fieldset>


</body>
</html>