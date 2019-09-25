
<?php
error_reporting(0);
   
   {

   }

?>
<html>
<head>
<title> Automatic Vehicle Plate Detection Parking Report </title>
<center><?php include_once "userview_header.php";?></center>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> -->
  <script>
  $( function() {
    $( "#startdate" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );

  $( function() {
    $( "#enddate" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );

  </script>
<style>
    
    .column {
    float: left;
    width: 50%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

* {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
    display: none;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

/* Style the header links */
.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

/* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

/* Change the background color on mouse-over */
.header a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the active/current link*/
.header a.active {
  background-color: dodgerblue;
  color: white;
}

/* Float the link section to the right */
.header-right {
  float: right;
}

/* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */ 
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  .header-right {
    float: none;
  }
}

.form_area
      {
        position: absolute;
        left: 68%;
        top:20%;        
        height: 98.4%;
        width: 600px;
        position: absolute;       
        background-color:#f1f1f1;
        opacity:.9;

      }
      .form_inner_area
      {
        left: 68%;
        top:25%;  
        height: 200px;
        width: 800px;
        position: absolute;         
      }

      input[type=submit_head] {
      float: right;
      width: 40%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 3px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      top:55%;
      
      
    }

    input[type=submit] {
      width: 20%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 3px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      top:55%;
      
      
    }
    
      input[type=submit]:hover {
      background-color: #45a049;
    }

    
    input[type=text] {
      width: 20%;
      padding: 12px 12px;
      margin: 3px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-family: inherit;
      font-size: 0.95em;
    }

    input[type=number] {
      width: 20%;
      padding: 12px 20px;
      margin: 3px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-family: inherit;
      font-size: 0.95em;
    }

    
      input[type=password] {
      width: 50%;
      padding: 12px 20px;
      margin: 3px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-family: inherit;
      font-size: 0.95em;
    }
    
    select {
      width: 20%;
      padding: 12px 20px;
      margin: 3px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-family: inherit;
      font-size: 0.95em;
    }

    .btn2 {
  background-color: #00cc66;
  border: none;
  color: black;
  padding: 16px 30px;
  text-align: center;
  font-size: 20px;
  margin: 6px 6px;
  transition: 0.3s;
  padding: 15px;
  width: 90px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 10px;
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

.btn2:hover {
  background-color: #3e8e41;
  color: white;
}

.btn:hover {
  background-color: #3e8e41;
  color: white;
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
/*body  
  {
    margin:0 auto;
    background: url("img/regcar.jpg") no-repeat;
    background-size: 100%;
    font-family: 'Open Sans', sans-serif;
  }*/

.column {
    float: left;
    width: 50%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

* {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
    display: none;
}

* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
/*.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}*/

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}

  </style>


</head>
<body>

</br>
   <center>  <legend><b> <h2> Automatic Vehicle Plate Detection for Fast Parking Report </b> </h2> </legend> </center>
      <br/>
<button class="btn" style="vertical-align:middle" onclick="location.href='logout.php';" > <span> Log OUT </span> </button>
      <div align="center" >

         Show Report Method : 

          <select name="report_method" id="report_method" onclick="reportselection()" >
          <option disabled selected value> Search By </option>
          <option value="Date">Date</option>
          <!-- <option value="Time">Time</option> -->
          <option value="AIUB_ID">AIUB ID</option>
          <option value="Vehicle_No">Vehicle No</option>
          </select>
         <!--  <button class="btn2" onclick="reportselection()">Select</button> -->

      <center>
      
      </br>
      <form id="date_wise" method="post" action="createreport.php" style="display: none;"  >
        <input type="hidden" name="reportmethod" value="date_wise"> 
      <h3> Date Wise Rport : </h3>
      Parking Start Date: <input type="text" name="startdate" id="startdate" readonly placeholder="Start Date"> <br>
      Parking End Date: <input type="text" name="enddate" id="enddate" readonly placeholder="End Date"> <br>
      <button type="submit" name="submit" class="btn2">  SUBMIT   </button> 
      </form>



      </br>
      <!-- <form id="time_wise" method="post" action="createreport.php"  style="display: none;" >
         <input type="hidden" name="reportmethod" value="time_wise"> 
      <h3> Time Wise Report: </h3>   
      Parking Start Hour: <input type="text" name="starttime" id="starttime" readonly placeholder="Start Time"> <br>
      Parking End End: <input type="text" name="endtime" id="endtime" readonly placeholder="End Time"> <br>
      <button type="submit" name="submit" class="btn2">  SUBMIT   </button> 
      </form> -->

      </br>


      <form id="aiubid_wise" method="post" action="createreport.php" style="display: none;"  >
         <input type="hidden" name="reportmethod" value="aiubid_wise"> 
      <h3> AIUB ID Wise: </h3>    <br>
      Enter AIUB ID: <input type="text" name="aiub_id" placeholder="AIUB ID"  value="" /> <br>
      <button type="submit" name="submit" class="btn2">  SUBMIT   </button> 
      </form>



      </br>
      <form id="vehcileno_wise" method="post" action="createreport.php"  style="display: none;" >
      <input type="hidden" name="reportmethod" value="vehcileno_wise"> 
       <h3> Vehicle Number Wise: </h3>  
      Enter Registered Vehicle Number:
      <br>
      <select name="vehicle_no_cityname">
          <option disabled selected value> City Name </option>
          <option value="Dhaka">Dhaka</option>
          <option value="Dhaka Metro">Dhaka Metro</option>
          <option value="Chotto Metro">Chotto Metro</option>
          <option value="Mymensingh">Mymensingh</option>
          <option value="Khulna">Khulna</option>
          <option value="Rajshahi">Rajshahi</option>
          <option value="Rangpur">Rangpur</option>
          <option value="Sylhet">Sylhet</option>
          <option value="Jessore">Jessore</option>
          <option value="Comilla">Comilla</option>
          <option value="Kustia">Kustia</option>
          <option value="Pabna">Pabna</option>
          </select>
        <br>
          <select name="vehicle_no_class">
          <option disabled selected value> Class </option>
          <option value="Ka">Ka</option>
          <option value="Kha">Kha</option>
          <option value="Ga ">Ga </option>
          <option value="Gha">Gha</option>
          <option value="Uma">Uma</option>
          <option value="Ca">Ca</option>
          <option value="Cha">Cha</option>
          <option value="Ja">Ja</option>
          <option value="Jha">Jha</option>
          <option value="Neo">Neo</option>
          <option value="Ta">Ta</option>
          <option value="Tha">Tha</option>
          <option value="Da">Da</option>
          <option value="Dha">Dha</option>
          <option value="Na">Na</option>
          <option value="Tha">Tha</option>
          <option value="Pha">Pha</option>
          <option value="Tha">Tha</option>
          <option value="Ba">Ba</option>
          <option value="Bha">Bha</option>
          <option value="Ma">Ma</option>
          <option value="Ya">Ya</option>
          <option value="Ba">Ra</option>
          <option value="La">La</option>
          <option value="Va">Va</option>
          </select>
          <br>
          <input type="number" name="vehicle_reg_no" placeholder="Vehicle Reg No"  value="" onKeyPress="if(this.value.length==2) return false;" />
          <br>
          <input type="number" name="vehicle_no" placeholder="Vehicle No"  value="" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" />
          <br>

         <button type="submit" name="submit" class="btn2">  SUBMIT   </button> 

      </form>
      </center>
   </div>  
</fieldset>

<script type="text/javascript">
   function reportselection() {
    var a = document.getElementById("date_wise");
    var b = document.getElementById("time_wise");
    var c = document.getElementById("aiubid_wise");
    var d = document.getElementById("vehcileno_wise");

    var selectid = document.getElementById("report_method");
    var selectionvalue = selectid.options[selectid.selectedIndex].value;
   console.log( selectid.value );
   

    if (selectionvalue == "Date" ) 
    {
       a.style.display = "block"
       b.style.display = "none"
       c.style.display = "none"
       d.style.display = "none"

    }
    if (selectionvalue == "Time" ) 
    {
      b.style.display = "block"
       a.style.display = "none"
       c.style.display = "none"
       d.style.display = "none"
    }
   if (selectionvalue == "AIUB_ID" )
   {
      c.style.display = "block"
       b.style.display = "none"
       a.style.display = "none"
       d.style.display = "none"
   }
   if (selectionvalue == "Vehicle_No" )      
   {
       d.style.display = "block"
       b.style.display = "none"
       c.style.display = "none"
       a.style.display = "none"
   }
}



</script>


</body>
</html>