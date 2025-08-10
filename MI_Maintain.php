<?php
    include './E_dbConnect.php';
    include './E_validation.php';

    $sql1 = "DELETE FROM $dbname.invxray WHERE DateOfTest < DATE_SUB(NOW(), INTERVAL 366 DAY);";
    $sql2 = "DELETE FROM $dbname.invlft WHERE ReportGenerated < DATE_SUB(NOW(), INTERVAL 366 DAY);";
    if (!(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2))) {
        echo 'Record Not Added! Error: ' . mysqli_error($conn) . '.';
    }
    mysqli_close($conn);
?>