<?php
$employeeName = "Kevin Slonka";
$hoursWorked = 40.0;
$hourlyRate = 54.50;
$federalTR = 24.5;
$stateTR = 5.5;
$grossPay = $hoursWorked * $hourlyRate;
$federalWH = $grossPay * ($federalTR / 100);
$stateWH = $grossPay * ($stateTR / 100);
$totalDeductions = $federalWH + $stateWH;
$netPay = $grossPay - $totalDeductions;
$annualIncome = 52 * 40 * $hourlyRate;
?>

<html>
	<head>
		<title>Payroll Calculator</title>
	</head>
<body>
	<h1>Payroll Information</h1>
	<h3>You fall in the 100,525$ to 191,950$ tax bracket, 24.5%</h3>
	<table border="18">
        <tr>
		<th>Subject</th>
		<th>Information</th>
        </tr>
	<tr>
		<td>Employee Name</td>
		<td><?php echo $employeeName; ?></td>
	</tr>
	<tr>
                <td>Hours Worked</td>
                <td><?php echo $hoursWorked; ?></td>
        </tr>
	<tr>
                <td>Hourly Rate</td>
                <td><?php echo number_format($hourlyRate, 2); ?>$</td>
        </tr>
	<tr>
                <td>Gross Pay</td>
                <td><?php echo number_format($grossPay, 2); ?>$</td>
        </tr>

	<tr>
                <td>Federal Tax Rate</td>
                <td><?php echo $federalTR; ?>%</td>
        </tr>
	<tr>
                <td>State Tax Rate</td>
                <td><?php echo $stateTR; ?>%</td>
        </tr>
	</table>




	<table border="10">
        <tr>
                <th>Items: <?php echo $employeeName; ?></th>
                <th>Amounts</th>
        </tr>
        <tr>
                <td>Federal Withholding</td>
                <td><?php echo number_format($federalWH, 2); ?>$</td>
        </tr>
	<tr>
                <td>State Withholding</td>
                <td><?php echo number_format($stateWH, 2); ?>$</td>
        </tr>
	<tr>
                <td>Total Deductions</td>
                <td><?php echo number_format($totalDeductions, 2); ?>$</td>
        </tr>
	<tr>
                <td>Net Pay</td>
                <td><?php echo number_format($netPay, 2); ?>$</td>
        </tr>


</body>
</html>

