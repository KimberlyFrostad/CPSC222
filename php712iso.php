<!DOCTYPE html>
<html>
<body>
    <h1>Birthdate Formatter</h1>
    <?php
    if (isset($_GET['datetime']) && !empty($_GET['datetime'])) {
        $datetime_str = $_GET['datetime'];

        $datetime = DateTime::createFromFormat('Y-F-j g:i A', $datetime_str);

        if ($datetime !== false) {
            $time = $datetime->format('H:i:s');
            $date = $datetime->format('Y-m-d');
            $iso_date = $date . ' ' . $time;
            echo "<p>$iso_date</p>";
        } else {
            echo "<p>Error: Invalid datetime format</p>";
        }
    } else {
        echo "<p>Error: Datetime not provided.</p>";
    }
    ?>
</body>
</html>
