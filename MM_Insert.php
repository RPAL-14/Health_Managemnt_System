<?php
include './M_CheckLogin.php';
include './E_dbConnect.php';
include './E_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid']) && isset($_POST['ouid']) && isset($_POST['status']) && isset($_POST['disease']) && isset($_POST['stage']) && isset($_POST['medicines']) && isset($_POST['family']) && isset($_POST['findings'])) {

        $buid = test_input($_POST['buid']);
        $ouid = test_input($_POST['ouid']);
        $hid = $_SESSION['hid'];

        $disease = test_input($_POST['disease']);
        $status = test_input($_POST['status']);
        $stage = test_input($_POST['stage']);
        $medicines = test_input($_POST['medicines']);
        $family = test_input($_POST['family']);
        $findings = test_input($_POST['findings']);

        if (isset($_POST['treated']) && !empty($_POST['treated'])) {
            $treated = test_input($_POST['treated']);
            $sqlStatement = "INSERT INTO $dbname.medical (BUID, Disease, OUID, HID, Status, Stage, Medicines, Family, Findings, Treated, Diagnosed, Other) VALUES ($buid, '$disease', $ouid, $hid, '$status', '$stage', '$medicines', '$family', '$findings', '$treated', NULL, NULL);";
        }

        if (isset($_POST['diagnosed']) && !empty($_POST['diagnosed'])) {
            $diagnosed = test_input($_POST['diagnosed']);
            $sqlStatement = "INSERT INTO $dbname.medical (BUID, Disease, OUID, HID, Status, Stage, Medicines, Family, Findings, Treated, Diagnosed, Other) VALUES ($buid, '$disease', $ouid, $hid, '$status', '$stage', '$medicines', '$family', '$findings', NULL, '$diagnosed', NULL);";
        }

        if (isset($_POST['other']) && !empty($_POST['other'])) {
            $other = test_input($_POST['other']);

            if (isset($_POST['treated']) && !empty($_POST['treated'])) {
                $treated = test_input($_POST['treated']);
                $sqlStatement = "INSERT INTO $dbname.medical (BUID, Disease, OUID, HID, Status, Stage, Medicines, Family, Findings, Treated, Diagnosed, Other) VALUES ($buid, '$disease', $ouid, $hid, '$status', '$stage', '$medicines', '$family', '$findings', '$treated', NULL, '$other');";
            } elseif (isset($_POST['diagnosed']) && !empty($_POST['diagnosed'])) {
                $diagnosed = test_input($_POST['diagnosed']);
                $sqlStatement = "INSERT INTO $dbname.medical (BUID, Disease, OUID, HID, Status, Stage, Medicines, Family, Findings, Treated, Diagnosed, Other) VALUES ($buid, '$disease', $ouid, $hid, '$status', '$stage', '$medicines', '$family', '$findings', NULL, '$diagnosed', '$other');";
            } else {
                $sqlStatement = "INSERT INTO $dbname.medical (BUID, Disease, OUID, HID, Status, Stage, Medicines, Family, Findings, Treated, Diagnosed, Other) VALUES ($buid, '$disease', $ouid, $hid, '$status', '$stage', '$medicines', '$family', '$findings', NULL, NULL, '$other');";
            }
        }

        if (mysqli_query($conn, $sqlStatement)) {
            echo '<script>alert("New record created successfully!");</script>';
        } else {
            echo '<script>alert("Record Not Added! Record for this beneficiary already exists.");</script>';
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
        input[type="number"] {
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
        <h2>Add your Medical History:</h2>
        <form id="medicalForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="buid">Benificiary UID:</label>
            <input type="number" id="BUID" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

            <label for="ouid">Operator UID:</label>
            <input type="number" id="OUID" name="ouid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

            <label for="currentStatus">Medical Condition Name:</label>
            <input type="text" id="currentStatus" required="" name="disease">

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
                <button type="submit">Submit</button>
            </center>
        </form>
        <br>
        <center>
            <a href="./M_HealthInfo.php"><button class="w-20 btn btn-primary btn-lg my-5" type="submit">Go back</button></a>
        </center>
    </div>

    <script>
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