<html>
		<head>
		<script type="text/javascript">
        function validate()
		{
			if(document.frm.uemail.value=='')
			{
				alert("Please Enter Email Address to continue.");
				document.frm.uemail.focus();	
				return false;
			}
			else{
			
				var emailPat = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/;
				var matchArray = document.frm.uemail.value.match(emailPat);
				if (matchArray == null)
				{
					alert("Please enter the valid Email Address to continue");
					document.frm.uemail.focus();
					return false;

				}
			}
			return true;
		}
		</script>
			<title>We've got a message for you!</title>
			<style type="text/css">
				body {font-family: Georgia;}
				h1 {font-style: italic;}

			</style>
		</head>
		<body>
			<h1><?php echo $errors; ?></h1>
			<form name='frm' action="" method="post" onsubmit="return validate();">
			<table>
			<tr><td>User Email:</td><td><input type="text" name="uemail" id="uemail"></td></tr>
			<tr><td><input type="submit" value="Submit"></td></tr>
			</table>
			</form>
		</body>
	</html>