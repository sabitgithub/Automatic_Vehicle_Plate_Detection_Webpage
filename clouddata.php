	<!DOCTYPE html>
	<html>
	<head>
		<title>  </title>
	</head>
	<body>
		<form name="myForm" id="myForm" target="_myFrame" action="http://api.thingspeak.com/update?api_key=BX4GOOLVFB42NBFS&field5=valid" method="POST">
    <p>
        <input name="test" value="test" />
    </p>
    <p>
        <input type="submit" value="Submit" />
    </p>
</form>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          document.forms["myForm"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 10000);
        }
    }
</script>


	
	</body>
	</html>