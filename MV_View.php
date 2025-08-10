<?php
include './M_CheckLogin.php';
include './E_dbConnect.php';
include './E_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid'])) {
        $buid = test_input($_POST['buid']);
        $sql = "SELECT Vaccine, Dose, Status, Reason, Name, Date FROM $dbname.vaccines AS V WHERE BUID = $buid AND Dose = (SELECT MAX(Dose) FROM $dbname.vaccines WHERE Vaccine = V.Vaccine) AND Dose <> 0;";

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
    <title>View Vaccination</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(images/Vaccination.png);
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
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

        h1 {
            color: #20869f;
        }

        .form-field {
            margin-bottom: 20px;
        }

        .form-field label {
            display: inline-block;
            margin-bottom: 5px;
        }

        .form-select,
        .form-field input[type="text"],
        .form-field input[type="number"],
        .form-field input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-field input[type="radio"] {
            margin-left: 0px;
            margin-top: 10px;
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
            background: transparent;
            cursor: pointer;
            border-radius: 5px;
            width: 30px;
            height: 30px;
        }

        .dark-mode-toggle:hover {
            background-color: transparent;
        }
    </style>
</head>

<body>
    <div class="container">
        <button id="dark-mode-toggle" class="dark-mode-toggle">
            <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
                <path fill="currentColor"
                    d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z"
                    transform="translate(-8 -8)" />
            </svg>
        </button>
        <section id="prescription">
        <center><h1>Vaccination Record:</h1></center>

            <h3>For viewing your vaccination records enter your details below:</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-container">
                    <div class="form-field">
                        <label for="BUID">Benificiary Unique ID:</label>
                        <input type="number" id="BUID" name="buid" required=""
                            value="<?php echo $_POST['buid'] ?? ''; ?>" maxlength="12"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                    <center>
                        <input type="submit" value="View Vaccination">
                    </center>
                </div>
            </form>
            <br>
            <center><a href="./M_HealthInfo.php"><button class="w-20 btn btn-success btn-lg my-3" type="submit">Go
                                back</button></a></center>
            <br>
            <center>
                <div id="data_div" style="display: block;">
                    <?php
            if (isset($result) && !empty($result)) {
                if (mysqli_num_rows($result) > 0) {
                    $index = 0;
                    ?>
                    <table border="1">
                        <tr>
                            <th style="font-weight: bold; padding: 10px;">Serial Number</th>
                            <th style="font-weight: bold; padding: 10px;">Vaccination For</th>
                            <th style="font-weight: bold; padding: 10px;">Vaccination Name</th>
                            <th style="font-weight: bold; padding: 10px;">Vaccination Date</th>
                            <th style="font-weight: bold; padding: 10px;">Dose(s)</th>
                            <th style="font-weight: bold; padding: 10px;">Status</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <?php
                                $vaccine = $row["Vaccine"];
                                $dose = $row["Dose"];
                                $status = $row["Status"];
                                $reason = $row["Reason"];
                                $date = $row["Date"];
                                $name = $row["Name"];
                                ?>
                            <td>
                                <?php $index++; echo $index ?? '-'; ?>
                            </td>
                            <td>
                                <?php echo $vaccine ?? '-'; ?>
                            </td>
                            <td>
                                <?php echo $name ?? '-'; ?>
                            </td>
                            <td>
                                <?php echo $date ?? '-'; ?>
                            </td>
                            <td>
                                <?php echo $dose ?? '-'; ?>
                            </td>
                            <td>
                                <?php echo $status ?? '-'; ?>
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
            </center>
        </section>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            var sections = document.querySelectorAll('.record-section');
            sections.forEach(function (section) {
                section.style.display = 'none';
            });

            // Show the selected section
            var selectedSection = document.getElementById(sectionId);
            selectedSection.style.display = 'block';
        }

        //Reason for Not taking the vaccination
        function showReason(isVisible) {
            var reasonDiv = document.getElementById("data_div");
            if (isVisible) {
                reasonDiv.style.display = "block";
            } else {
                reasonDiv.style.display = "none";
            }
        }

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