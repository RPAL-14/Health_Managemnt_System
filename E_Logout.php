<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            session_start();
            if (file_exists('./sample2.png')) { unlink('./sample2.png'); }
            session_unset();
            session_destroy();
        ?>
        <script>
            window.location.href = "./H_Home.php";
            alert("Logged Out Successfully!");
        </script>
        <?php
            exit(); // Ensure no more code is executed after redirection
        ?>
    </head>
</html>