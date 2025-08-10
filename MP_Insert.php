<?php
include './M_CheckLogin.php';
include './getAllergies.php';
include './E_dbConnect.php';
include './E_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid']) && isset($_POST['ouid']) && isset($_POST['remarks']) && isset($_POST['followup']) && isset($_POST['allergies']) && isset($_POST['height']) && isset($_POST['weight']) && isset($_POST['medicines'])) {

        $buid = test_input($_POST['buid']);
        $ouid = test_input($_POST['ouid']);
        $hid = $_SESSION['hid'];
        $remarks = test_input($_POST['remarks']);
        $followup = test_input($_POST['followup']);
        $medicines = test_input($_POST['medicines']);

        $height = test_input($_POST['height']);
        $weight = test_input($_POST['weight']);
        $allergies = test_input($_POST['allergies']);
        $bmi = $weight / ($height * $height);

        $tempSql = "SELECT AllergiesReactions FROM $dbname.clientinfo WHERE UID = $buid;";
        $result = mysqli_query($conn, $tempSql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $value = $row['AllergiesReactions'];

            if (!is_null($value) && $value !== "") {
                $new_allergies = $value . ", " . $allergies;
            } else {
                $new_allergies = $allergies;
            }
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }

        $sql1 = "INSERT INTO $dbname.prescription (BUID, OUID, HID, Remarks, FollowUp, Medicines) VALUES ($buid, '$ouid', '$hid', '$remarks', '$followup', '$medicines');";
        $sql2 = "UPDATE $dbname.clientinfo SET AllergiesReactions = '$new_allergies', Height = $height, Weight = $weight, BMI = $bmi WHERE UID = $buid;";

        if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
            echo '<script>alert("New record created successfully!");</script>';
        } else {
            echo '<script>alert("Record Not Added! Error: ' . mysqli_error($conn) . '.");</script>';
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
    <title>Health Records</title>
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
            margin-top: 0px;
        }

        .form-field label {
            display: inline-block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
    </style>
</head>

<body>
    <div class="container">
        <button id="dark-mode-toggle" class="dark-mode-toggle">
            <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
                <path fill="currentColor" d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z" transform="translate(-8 -8)" />
            </svg>
        </button>
        <section id="prescription">
            <h2>Insert New Record:</h2>
            <p>Please enter the corresponding details.</p>

            <div class="form-container" style="padding-left: 10px;">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-field">
                        <label for="BUID">Benificiary Unique ID:</label>
                        <input type="number" id="BUID" name="buid" required="" maxlength="12" onkeyup="showHint(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>

                    <div class="form-field">
                        <label for="OUID">Operator Unique ID:</label>
                        <input type="number" id="OUID" name="ouid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>

                    <div class="form-field">
                        <label for="height">Height (in meters) :</label>
                        <input type="number" step="0.01" id="height" name="height" required="" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>

                    <div class="form-field">
                        <label for="weight">Weight (in Kilograms) :</label>
                        <input type="number" id="weight" name="weight" required="" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>

                    <div class="form-field">
                        <label for="Allergies">Allergies or Reactions (if any) :</label>
                        <input type="text" id="Allergies" name="allergies" required="" placeholder="">
                        <p><span id="txtHint"></span></p>
                    </div>

                    <div class="form-field">
                        <label for="Remarks">Remarks:</label>
                        <input type="text" id="Remarks" name="remarks" required="">
                    </div>

                    <div class="form-field">
                        <label for="followUpDate">Follow-up Date:</label>
                        <input type="date" id="followUpDate" name="followup" required="">
                    </div>

                    <div class="form-field">
                        <label for="Medicine">Medicine:</label>
                        <input type="text" name="medicines" required="">
                    </div>

                    <center>
                        <input type="submit" value="Submit Prescription">
                    </center>
                </form>
                <br>
                <center>
                    <a href="./M_HealthInfo.php"><button class="btn btn-success" type="submit">Go back</button></a>
                </center>
            </div>
        </section>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            var sections = document.querySelectorAll('.record-section');
            sections.forEach(function(section) {
                section.style.display = 'none';
            });

            // Show the selected section
            var selectedSection = document.getElementById(sectionId);
            selectedSection.style.display = 'block';
        }

        function showHint(str) {
            if (str.length < 12) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "./getAllergies.php?q=" + str, true);
                xmlhttp.send();
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