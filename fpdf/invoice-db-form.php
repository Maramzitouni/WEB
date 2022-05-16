<?php



?>
<html>
	<head>
		<title>Invoice Generator</title>
	</head>
	<body>

		<form method='get' action='invoice-db.php'>
			<!--<select name='invoiceID'>
				/*
					$query=mysqli_query($con,'select * from invoice');
					while($invoice=mysqli_fetch_array($query)){
						echo "<option value='".$invoice['invoiceID']."'>".$invoice['invoiceID']."</option>";
					}
				*/?>
			</select> -->
			<input type='submit' value='Generate'>
		</form>
	</body>
</html>
