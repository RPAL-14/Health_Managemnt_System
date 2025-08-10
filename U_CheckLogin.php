<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    if (!isset($_SESSION['userUID'])) {
    ?>
        <script>
            window.location.href = "./u_login.php";
        </script>
    <?php
        exit(); // Ensure no more code is executed after redirection
    }
    if (isset($_SESSION['u_last_activity']) && time() - $_SESSION['u_last_activity'] > 600) {
        session_unset(); // Unset session variables
        session_destroy(); // Destroy session data in storage
    ?>
        <script>
            window.location.href = "./u_login.php";
        </script>
    <?php
        exit();
    }
    $_SESSION['u_last_activity'] = time(); // Update last activity timestamp
    ?>
</head>
</html>