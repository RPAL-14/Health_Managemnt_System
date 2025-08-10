<?php
    include './M_CheckLogin.php';
    include './E_validation.php';
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
            margin: 30px auto;
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
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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

        .dark-mode-toggle:hover{
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
                <path fill="currentColor"
                    d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z"
                    transform="translate(-8 -8)" />
            </svg>
        </button>
    <section id="prescription">
        <div class="form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h2>Update Prescription by filling out the following details:</h2>

                <div class="form-field">
                    <label for="BUID">Benificiary Unique ID:</label>
                    <input type="number" id="BUID" name="buid" value="<?php echo $_POST['buid'] ?? ''; ?>" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>

                <div class="form-field">
                    <label for="OUID">Operator Unique ID:</label>
                    <input type="number" id="OUID" name="ouid" required="" value="<?php echo $_POST['ouid'] ?? ''; ?>" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>

                <div class="form-field">
                    <label for="HID">Hospital/Institution ID:</label>
                    <input type="number" id="HID" name="hid" required="" value="<?php echo $_POST['hid'] ?? ''; ?>" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>

                <div class="form-field">
                    <label for="dateOfPrescription">Issue Date of Prescription:</label>
                    <input type="date" id="dateOfPrescription" name="issuedate" required="" value="<?php echo $_POST['issuedate'] ?? ''; ?>">
                </div>

                <center>
                    <button class="btn">Find Prescription</button>
                </center>
            </form>
            <br>
            <center><a href="./M_HealthInfo.php"><button class="w-20 btn btn-success btn-lg my-3" type="submit">Go back</button></a></center>
        </div>
    </section>

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
    </script>

    <div id="data_div" style="display: none;">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <section id="prescription" class="record-section">
                <div class="form-container">
                    <h2>Prescription Found! 
                        <br><br>Fill in the fields below:</h2>
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
                        <input type="text" id="Allergies" name="allergies" required="">
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
                    <center><input type="submit" value="Submit Prescription"></center>
                </div>
            </section>
        </form>
    </div>
</div>

    <script>
        function showFurther(isVisible) {
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

    <?php
        if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['hid']) && isset($_POST['ouid']) && isset($_POST['issuedate']) && isset($_POST['buid']) && !empty($_POST['hid']) && !empty($_POST['ouid']) && !empty($_POST['issuedate']) && !empty($_POST['buid'])) {
            include './E_dbConnect.php';
            $hid = test_input($_POST['hid']);
            $ouid = test_input($_POST['ouid']);
            $prescriptiondate = test_input($_POST['issuedate']);
            $buid = test_input($_POST['buid']);

            $_SESSION["thid"] = $hid;
            $_SESSION["touid"] = $ouid;
            $_SESSION["tprescriptiondate"] = $prescriptiondate;
            $_SESSION["tbuid"] = $buid;

            $tempSql = "SELECT * FROM $dbname.prescription WHERE BUID = $buid AND CurrentDate = '$prescriptiondate' AND OUID = $ouid AND HID = $hid;";

            if ((mysqli_num_rows(mysqli_query($conn, $tempSql))) > 0) {
                ?><script>showFurther(true);</script><?php
            } else {
                echo '<script>alert("Record Not Found!");</script>!';
            }
            mysqli_close($conn);
        }

        if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['remarks']) && isset($_POST['followup']) && isset($_POST['allergies']) && isset($_POST['height']) && isset($_POST['weight']) && isset($_POST['medicines'])) {
            include './E_dbConnect.php';
            $remarks = test_input($_POST['remarks']);
            $followup = test_input($_POST['followup']);
            $medicines = test_input($_POST['medicines']);

            $height = test_input($_POST['height']);
            $weight = test_input($_POST['weight']);
            $allergies = test_input($_POST['allergies']);
            $bmi = $weight / ($height * $height);

            $hid = $_SESSION["thid"];
            $ouid = $_SESSION["touid"];
            $prescriptiondate = $_SESSION["tprescriptiondate"];
            $buid = $_SESSION["tbuid"];

            if (!empty($buid) && !empty($ouid) && !empty($hid) && !empty($prescriptiondate)) {
                $sql1 = "UPDATE $dbname.prescription SET Remarks = '$remarks', FollowUp = '$followup', Medicines = '$medicines' WHERE BUID = $buid AND OUID = $ouid AND HID = $hid AND CurrentDate = '$prescriptiondate';";

                $sql2 = "UPDATE $dbname.clientinfo SET AllergiesReactions = '$allergies', Height = $height, Weight = $weight, BMI = $bmi WHERE UID = $buid;";

                if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
                    echo '<script>alert("Record updated successfully!");</script>';
                }
            }
            else {
                echo '<script>alert("Record Not Updated! Error: ' . mysqli_error($conn) . '.");</script>';
            }
            mysqli_close($conn);
        }
    ?>

</body>

</html>