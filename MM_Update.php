<?php
include './M_CheckLogin.php';
include './E_validation.php';
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
            max-width: 700px;
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
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
    <div class="container">
        <button id="dark-mode-toggle" class="dark-mode-toggle">
            <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
                <path fill="currentColor" d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z" transform="translate(-8 -8)" />
            </svg>
        </button>
        <h2>Update your Medical History:</h2>

        <form id="medicalForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="buid">Benificiary UID:</label>
            <input type="number" id="BUID" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $_POST['buid'] ?? ''; ?>">

            <label for="currentStatus">Medical Condition Name:</label>
            <input type="text" id="currentStatus" required="" name="disease" value="<?php echo $_POST['disease'] ?? ''; ?>">

            <center><button type="submit">Submit</button></center>
        </form>
        <br>
        <center>
            <a href="./M_HealthInfo.php"><button class="w-20 btn btn-primary btn-lg my-3">Go back</button></a>
        </center>
        <br>

        <div id="data_div" style="display: none;">
            <h2>Record Found!</h2>
            <form id="medicalForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                <label for="currentStatus">Current Status:</label>
                <input type="radio" id="currentStatus" name="status" value="Ongoing" onclick="showDiagnosed(true);showOther(false);showTreated(false)"> Ongoing
                <input type="radio" id="currentStatus" name="status" value="Treated" onclick="showDiagnosed(false);showOther(false);showTreated(true)"> Treated
                <input type="radio" id="currentStatus" name="status" value="Other" onclick="showDiagnosed(true);showOther(true);showTreated(true)"> Other
                <br>
                <br>

                <div id="other_div" style="display: none;">
                    <br>
                    <label for="medicinesGiven">Other Information:</label>
                    <input type="text" id="medicinesGiven" name="other">
                </div>

                <div id="diagnosed_div" style="display: none;">
                    <br>
                    <label for="diagnosedDate">Diagnosed Date:</label>
                    <input type="date" id="diagnosedDate" name="diagnosed">
                </div>

                <div id="treated_div" style="display: none;">
                    <br>
                    <label for="treatedDate">Treated Date:</label>
                    <input type="date" id="treatedDate" name="treated">
                </div>

                <label for="stageSeverity">Stage/Severity:</label>
                <input type="text" id="stageSeverity" name="stage">

                <label for="medicinesGiven">Medicines Given:</label>
                <input type="text" id="medicinesGiven" name="medicines">

                <label for="familyHistory">Family History:</label>
                <input type="radio" id="familyHistory" name="family" value="Yes"> Yes
                <input type="radio" id="familyHistory" name="family" value="No"> No
                <br>
                <br>

                <label for="specialFindings">Any Special Findings:</label>
                <input type="text" id="specialFindings" name="findings">

                <center>
                    <button type="submit" name="tsubmit">Update</button>
                </center>
            </form>
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

        function showFurther(isVisible) {
            var reasonDiv = document.getElementById("data_div");
            if (isVisible) {
                reasonDiv.style.display = "block";
            } else {
                reasonDiv.style.display = "none";
            }
        }

        function showDiagnosed(isVisible) {
            var reasonDiv = document.getElementById("diagnosed_div");
            if (isVisible) {
                reasonDiv.style.display = "block";
            } else {
                reasonDiv.style.display = "none";
            }
        }

        function showTreated(isVisible) {
            var reasonDiv = document.getElementById("treated_div");
            if (isVisible) {
                reasonDiv.style.display = "block";
            } else {
                reasonDiv.style.display = "none";
            }
        }

        function showOther(isVisible) {
            var reasonDiv = document.getElementById("other_div");
            if (isVisible) {
                reasonDiv.style.display = "block";
            } else {
                reasonDiv.style.display = "none";
            }
        }
    </script>

    <?php
    if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['buid']) && isset($_POST['disease'])) {
        include './E_dbConnect.php';
        $buid = test_input($_POST['buid']);
        $disease = test_input($_POST['disease']);
        $_SESSION['tbuid'] = $buid;
        $_SESSION['tdisease'] = $disease;

        $tempSql = "SELECT * FROM $dbname.medical WHERE BUID = $buid AND Disease = '$disease';";

        if ((mysqli_num_rows(mysqli_query($conn, $tempSql))) > 0) {
    ?>
            <script>
                showFurther(true);
            </script>
    <?php
        } else {
            echo '<script>alert("Record Not Found!");</script>!';
        }
        mysqli_close($conn);
    }

    if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['tsubmit'])) {

        include './E_dbConnect.php';
        $flag = true;

        function addDb($conn, $sql)
        {
            if (mysqli_query($conn, $sql) == false) {
                echo '<script>alert("Record Not Updated! Error: ' . mysqli_error($conn) . '.");</script>';
                $_GLOBALS['flag'] = false;
            }
        }

        $buid = $_SESSION['tbuid'];
        $disease = $_SESSION['tdisease'];

        if (isset($_POST['status']) && !empty($_POST['status'])) {
            $status = test_input($_POST['status']);
            $sql = "UPDATE $dbname.medical SET Status = '$status' WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        } else {
            $sql = "UPDATE $dbname.medical SET Status = NULL WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        }

        if (isset($_POST['treated']) && !empty($_POST['treated'])) {
            $treated = test_input($_POST['treated']);
            $sql = "UPDATE $dbname.medical SET Treated = '$treated' WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        } else {
            $sql = "UPDATE $dbname.medical SET Treated = NULL WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        }

        if (isset($_POST['diagnosed']) && !empty($_POST['diagnosed'])) {
            $diagnosed = test_input($_POST['diagnosed']);
            $sql = "UPDATE $dbname.medical SET Diagnosed = '$diagnosed' WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        } else {
            $sql = "UPDATE $dbname.medical SET Diagnosed = NULL WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        }

        if (isset($_POST['other']) && !empty($_POST['other'])) {
            $other = test_input($_POST['other']);
            $sql = "UPDATE $dbname.medical SET Other = '$other' WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        } else {
            $sql = "UPDATE $dbname.medical SET Other = NULL WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        }

        if (isset($_POST['stage']) && !empty($_POST['stage'])) {
            $stage = test_input($_POST['stage']);
            $sql = "UPDATE $dbname.medical SET Stage = '$stage' WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        } else {
            $sql = "UPDATE $dbname.medical SET Stage = NULL WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        }
        if (isset($_POST['medicines']) && !empty($_POST['medicines'])) {
            $medicines = test_input($_POST['medicines']);
            $sql = "UPDATE $dbname.medical SET Medicines = '$medicines' WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        } else {
            $sql = "UPDATE $dbname.medical SET Medicines = NULL WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        }
        if (isset($_POST['family']) && !empty($_POST['family'])) {
            $family = test_input($_POST['family']);
            $sql = "UPDATE $dbname.medical SET Family = '$family' WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        } else {
            $sql = "UPDATE $dbname.medical SET Family = NULL WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        }
        if (isset($_POST['findings']) && !empty($_POST['findings'])) {
            $findings = test_input($_POST['findings']);
            $sql = "UPDATE $dbname.medical SET Findings = '$findings' WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        } else {
            $sql = "UPDATE $dbname.medical SET Findings = NULL WHERE BUID = $buid AND Disease = '$disease';";
            addDb($conn, $sql);
        }

        if ($flag) {
            echo '<script>alert("Record updated successfully!");</script>';
        }

        mysqli_close($conn);
    }
    ?>
</body>

</html>