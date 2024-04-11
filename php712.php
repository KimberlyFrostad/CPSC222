<!DOCTYPE html>
<html>
<head>
	<title>Birthdate Converter</title>
</head>
<body>
	<h1>Birthdate Formatter</h1>
	<form action="php712hyper.php" method="post">
	<table border = "2">
	<tr>
		<th>Month</th>
		<th>Date</th>
		<th>Year</th>
		<th>Hour</th>
		<th>Minute</th>
		<th>AM/PM</th>
	</tr>
	<tr>
	<td>
	<select name="month">
	<?php
	$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	foreach ($months as $month) {
	echo "<option value='$month'>$month</option>";
	}
	?>
	</select>
	</td>
	<td>
	<select name="day">
	<?php
	for ($i = 1; $i <= 31; $i++) {
	echo "<option value='$i'>$i</option>";
	}
	?>
	</select>
	</td>
	<td>
	<select name="year">
	<?php
	$current_year = date("Y");
	for ($i = $current_year; $i >= 1900; $i--) {
	echo "<option value='$i'>$i</option>";
	}
	?>
	</select>
	</td>
	<td>
	<select name="hour">
	<?php
	for ($i = 1; $i <= 12; $i++) {
	echo "<option value='$i'>$i</option>";
	}
	?>
	</select>
	</td>
	<td>
	<select name="minute">
	<?php
	for ($i = 0; $i <= 59; $i++) {
	$minute = ($i < 10) ? "0$i" : $i;
        echo "<option value='$minute'>$minute</option>";
	}
	?>
	</select>
	</td>
	<td>
	<select name="ampm">
	<option value="AM">AM</option>
	<option value="PM">PM</option>
	</select>
	</td>
	</tr>
	<tr>
    	<td colspan="6" style="text-align: center;">
        <input type="submit" value="Format Date">
    	</td>
	</tr>  
</table>
</form>
</body>
</html>

