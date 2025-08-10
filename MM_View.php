<?php
include './M_CheckLogin.php';
include './E_dbConnect.php';
include './E_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid'])) {
        $buid = test_input($_POST['buid']);
        $sql = "SELECT * FROM $dbname.medical WHERE BUID = $buid";
        $result = mysqli_query($conn, $sql);
        if (isset($result) && mysqli_num_rows($result) == 0) {
            echo '<script>alert("No records found!");</script>';
        }
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(./images/MedicalHistory.png);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="datetime-local"] {
            width: 50%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-left: 20px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Darkmode */
        .darkmode .container {
            background-color: #1A1B1F;
            color: white;
        }

        .dark-mode-toggle {
            position: absolute;
            z-index: 100;
            top: 1em;
            right: 1em;
            color: var(--foreground);
            border: 2px solid currentColor;
            padding: 4px;
            background: transparent;
            cursor: pointer;
            border-radius: 5px;
            width: 30px;
            height: 30px;
        }
    </style>
</head>

<body>

    <div class="container" style="margin-top: 100px;">
        <button id="dark-mode-toggle" class="dark-mode-toggle">
            <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
                <path fill="currentColor" d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z" transform="translate(-8 -8)" />
            </svg>
        </button>
        <center>
            <h2>To view your Medical History enter the following detail:</h2>
            <form id="medicalForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label for="buid">Benificiary UID:</label>
                <input type="number" value="<?php echo $_POST['buid'] ?? ''; ?>" id="BUID" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                <br>
                <button type="submit">Submit</button>
        </center>
        </form>
        <br>
        <center><a href="./M_HealthInfo.php"><button class="w-20 btn btn-primary btn-lg my-3" type="submit">Go back</button></a>
        </center>
        <br>
        <div id="data_div" style="display: block;">
            <?php
            if (isset($result) && !empty($result)) {
                if (mysqli_num_rows($result) > 0) {
                    $index = 0;
            ?>
                    <table border="1">
                        <tr>
                            <th style="font-weight: bold;">Serial Number</th>
                            <th style="font-weight: bold;">Medical Condition Name</th>
                            <th style="font-weight: bold;">Current Status</th>
                            <th style="font-weight: bold;">Stage/Severity</th>
                            <th style="font-weight: bold;">Medicines Given</th>
                            <th style="font-weight: bold;">Family History</th>
                            <th style="font-weight: bold;">Special Findings</th>
                            <th style="font-weight: bold;">Diagnosed Date</th>
                            <th style="font-weight: bold;">Treated Date</th>
                            <th style="font-weight: bold;">Other Information</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <?php
                                $disease = $row["Disease"];
                                $status = $row["Status"];
                                $stage = $row["Stage"];
                                $medicines = $row["Medicines"];
                                $family = $row["Family"];
                                $findings = $row["Findings"];
                                $diagnosed = $row["Diagnosed"];
                                $treated = $row["Treated"];
                                $other = $row["Other"];
                                ?>

                                <td><?php $index++;
                                    echo $index ?? '-'; ?></td>
                                <td><?php echo $disease ?? '-'; ?></td>
                                <td><?php echo $status ?? '-'; ?></td>
                                <td><?php echo $stage ?? '-'; ?></td>
                                <td><?php echo $medicines ?? '-'; ?></td>
                                <td><?php echo $family ?? '-'; ?></td>
                                <td><?php echo $findings ?? '-'; ?></td>
                                <td><?php echo $diagnosed ?? '-'; ?></td>
                                <td><?php echo $treated ?? '-'; ?></td>
                                <td><?php echo $other ?? '-'; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
            <?php
                }
            }
            ?>
            <br>
        </div>
    </div>

    <script>
        // check for saved 'darkMode' in localStorage
        let darkMode = localStorage.getItem('darkMode');

        const darkModeToggle = document.querySelector('#dark-mode-toggle');

        const enableDarkMode = () => {
            // 1. Add the class to the body
            document.body.classList.add('darkmode');
            // 2. Update darkMode in localStorage
            localStorage.setItem('darkMode', 'enabled');
        }

        const disableDarkMode = () => {
            // 1. Remove the class from the body
            document.body.classList.remove('darkmode');
            // 2. Update darkMode in localStorage 
            localStorage.setItem('darkMode', null);
        }

        // If the user already visited and enabled darkMode
        // start things off with it on
        if (darkMode === 'enabled') {
            enableDarkMode();
        }

        // When someone clicks the button
        darkModeToggle.addEventListener('click', () => {
            // get their darkMode setting
            darkMode = localStorage.getItem('darkMode');

            // if it not current enabled, enable it
            if (darkMode !== 'enabled') {
                enableDarkMode();
                // if it has been enabled, turn it off  
            } else {
                disableDarkMode();
            }
        });
    </script>
</body>

</html>