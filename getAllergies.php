<?php
    include './E_dbConnect.php';
    if (isset($_GET['q']) && !empty($_GET['q'])) {
        $buid = mysqli_real_escape_string($conn, $_GET['q']);
        $tempSql = "SELECT AllergiesReactions FROM $dbname.clientinfo WHERE UID = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $tempSql)) {
            mysqli_stmt_bind_param($stmt, "s", $buid);
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $value = $row['AllergiesReactions'];
                echo "Following are current allergies and reactions as per the database:\n$value";
            } else {
                echo "Error executing query: " . mysqli_error($conn);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid input";
    }
    mysqli_close($conn);
?>