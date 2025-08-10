<?php
include './M_CheckLogin.php';
include './E_dbConnect.php';
include './E_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid']) && isset($_POST['dateofprescription'])) {

        $buid = test_input($_POST['buid']);
        $specificdate = test_input($_POST['dateofprescription']);
        if ($specificdate == "") {
            $sql = "SELECT * FROM $dbname.prescription WHERE BUID = $buid ORDER BY CurrentDate DESC;";
        } else {
            $sql = "SELECT * FROM $dbname.prescription WHERE BUID = $buid AND CurrentDate = '$specificdate' ORDER BY CurrentDate DESC;";
        }
        $result = mysqli_query($conn, $sql);
        $tempresult = mysqli_query($conn, "SELECT * FROM $dbname.clientinfo WHERE UID = $buid;");
        if (isset($result) && mysqli_num_rows($result) == 0) {
            echo '<script>alert("No records found!");</script>';
        }
        mysqli_close($conn);
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Records</title>
    <link rel="icon" type="image/x-icon" href="./logo.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(images/Photo.png);
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        section {
            padding: 2em;
            padding-bottom: 0px;
            padding-top: 0px;
        }

        h2 {
            color: #20869f;
        }

        .form-field {
            margin-bottom: 20px;
        }

        .form-field label {
            display: inline-block;
            margin-bottom: 5px;
        }

        .form-field input[type="text"],
        .form-field input[type="number"],
        .form-field input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-field input[type="radio"] {
            margin-left: 0px;
        }

        .form-field:last-child {
            justify-content: center;
        }

        button {
            background-color: #159a15;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4caf50;
        }

        input[type="submit"] {
            background-color: #159a15;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4caf50;
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
            background: white;
            cursor: pointer;
            border-radius: 5px;
            width: 30px;
            height: 30px;
        }

        .darkmode .dark-mode-toggle {
            background: black;
        }

        .dark-mode-toggle:hover {
            background-color: white;
        }

        .darkmode .dark-mode-toggle:hover {
            background: black;
        }

        .darkmode table {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <button id="dark-mode-toggle" class="dark-mode-toggle">
            <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
                <path fill="currentColor" d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z" transform="translate(-8 -8)" />
            </svg>
        </button>
        <section id="prescription" class="record-section">
            <h2>For viewing the prescription enter your details below:</h2>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div class="form-container">
                    <div class="form-field">
                        <label for="BUID">Benificiary Unique ID:</label>
                        <input type="number" id="BUID" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $_POST['buid'] ?? ''; ?>">
                    </div>

                    <div class="form-field">
                        <label for="followUpDate">Date of prescription: (Optional)</label>
                        <input type="date" id="followUpDate" name="dateofprescription" value="<?php echo $_POST['CurrentDate'] ?? ''; ?>">
                    </div>

                    <center>
                        <button class="w-20 btn btn-success btn-lg my-3" type="submit">View</button>
                    </center>
                </div>
            </form>
            <br>
            <center>
                <a href="./M_HealthInfo.php"><button>Go back</button></a>
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
                                <th style="font-weight: bold;">Hospital ID</th>
                                <th style="font-weight: bold;">Date of Generation</th>
                                <th style="font-weight: bold;">Height</th>
                                <th style="font-weight: bold;">Weight</th>
                                <th style="font-weight: bold;">BMI</th>
                                <th style="font-weight: bold;">Allergies / Reactions</th>
                                <th style="font-weight: bold;">Remarks</th>
                                <th style="font-weight: bold;">Follow-Up Date</th>
                                <th style="font-weight: bold;">Medicines Prescribed</th>
                            </tr>
                            <?php
                            $temprow = mysqli_fetch_assoc($tempresult);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <?php
                                    $hid = $row["HID"];
                                    $remarks = $row["Remarks"];
                                    $followup = $row["FollowUp"];
                                    $medicines = $row["Medicines"];

                                    $height = $temprow["Height"];
                                    $weight = $temprow["Weight"];
                                    $bmi = $temprow["BMI"];
                                    $allergies = $temprow["AllergiesReactions"];

                                    ?>
                                    <td>
                                        <?php $index++;
                                        echo $index ?? '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $hid ?? '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["CurrentDate"] ?? '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $height ?? '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $weight ?? '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $bmi ?? '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $allergies ?? '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $remarks ?? '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $followup ?? '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $medicines ?? '-'; ?>
                                    </td>
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
        </section>
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