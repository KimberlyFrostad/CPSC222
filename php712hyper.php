<!DOCTYPE html>
<html>
<head>
        <title>Birthdate Converter</title>
</head>
<body>
        <h1>Birthdate Formatter</h1>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = htmlspecialchars($_POST["day"]);
    $month = htmlspecialchars($_POST["month"]);
    $year = htmlspecialchars($_POST["year"]);
    $hour = htmlspecialchars($_POST["hour"]);
    $minute = htmlspecialchars($_POST["minute"]);
    $ampm = htmlspecialchars($_POST["ampm"]);

    $datetime_str = "$year-$month-$day $hour:$minute $ampm";

    $datetime = DateTime::createFromFormat('Y-F-j g:i A', $datetime_str);

    if ($datetime !== false) {
        $day_of_week = $datetime->format('l');

        $formatted_date = $datetime->format('F jS, Y - h:i A');
        echo "<p>$day_of_week, $formatted_date</p>";
        echo "<p><a href='php712iso.php?datetime=" . urlencode($datetime_str) . "'>Show date in ISO format</a></p>";
    } else {
        echo "Invalid date-time format: $datetime_str";
    }
}
?>
</body>
</html>
