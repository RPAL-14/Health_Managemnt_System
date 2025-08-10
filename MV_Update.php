<?php
include './M_CheckLogin.php';
include './MI_Maintain.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vaccination</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(images/Vaccination.png);
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
                <path fill="currentColor" d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z" transform="translate(-8 -8)" />
            </svg>
        </button>
        <section id="prescription">
            <center>
                <h1>Vaccination Record:</h1>
            </center>

            <h3>For updating your vaccination records, enter your details below:</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div class="form-container">
                    <div class="form-field">
                        <label for="BUID">Beneficiary User ID:</label>
                        <input type="number" value="<?php echo $_POST['buid'] ?? ''; ?>" id="BUID" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>

                    <div class="form-field">
                        <label for="OUID">Operator User ID:</label>
                        <input type="number" value="<?php echo $_POST['ouid'] ?? ''; ?>" id="OUID" name="ouid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>

                    <div class="form-field">
                        <label for="HID">Hospital ID:</label>
                        <input type="number" id="HID" value="<?php echo $_POST['hid'] ?? ''; ?>" name="hid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>

                    <div class="form-field">
                        <label for="HID">Date of Vaccination:</label>
                        <input type="date" id="followUpDate" value="<?php echo $_POST['mydate'] ?? ''; ?>" name="mydate" required="">
                    </div>

                    <div class="form-field">
                        <label for="Vaccination">Vaccination For:</label>
                        <select class="form-select" id="Vaccination" name="vaccine" required="" value="<?php echo $_POST['vaccine'] ?? ''; ?>">
                            <option value="">Choose...</option>
                            <option>Cholera</option>
                            <option>Rabies</option>
                            <option>Tetanus</option>
                            <option>Typhoid_Fever</option>
                            <option>Bubonic_Plague</option>
                            <option>Tuberculosis</option>
                            <option>Diphtheria</option>
                            <option>Scarlet_Fever</option>
                            <option>Pertussis</option>
                            <option>Yellow_Fever</option>
                            <option>Typhus</option>
                            <option>Influenza</option>
                            <option>Anthrax</option>
                            <option>Tick_Borne_Encephalitis</option>
                            <option>Polio</option>
                            <option>Japanese_Encephalitis</option>
                            <option>Adenovirus_4_and_7</option>
                            <option>Measles</option>
                            <option>Mumps</option>
                            <option>Rubella</option>
                            <option>Pneumonia</option>
                            <option>Meningitis</option>
                            <option>Hepatitis_B</option>
                            <option>Chicken_Pox</option>
                            <option>Haemophilus_Influenzae_Type_B_HiB</option>
                            <option>Q_Fever</option>
                            <option>Hantavirus_Hemorrhagic_Fever_With_Renal_Syndrome</option>
                            <option>Hepatitis_A</option>
                            <option>Lyme_Disease</option>
                            <option>Rotavirus</option>
                            <option>COVID_19</option>
                            <option>Chikungunya</option>
                            <option>Ebola</option>
                            <option>Respiratory_Syncytial_Virus</option>
                            <option>Dengue_Fever</option>
                            <option>Malaria</option>
                            <option>Enterovirus_71</option>
                            <option>Hepatitis_E</option>
                            <option>Non_Small_Cell_Lung_Carcinoma</option>
                            <option>Shungles</option>
                            <option>Human_Papillomavirus</option>
                            <option>Argentine_Hemorrhagic_Fever</option>
                            <option>Pneumococcal_Conjugate_Vaccine</option>
                        </select>
                    </div>

                    <center>
                        <button class="btn">Submit</button>
                    </center>
                </div>
            </form>

            <br>
            <center><a href="./M_HealthInfo.php"><button class="btn btn-success">Go back</button></a></center>
            <br>

            <div id="data_div" style="display: none;">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <h2>Found your vaccination record! <br>Enter your details below:</h2>
                    <div class="form-container">
                        <label>Vaccination Status:</label>
                        <input type="radio" id="vaccinated_yes" name="status" value="Yes" onclick="showReason(false);showRest(true)"> Yes
                        <input type="radio" id="vaccinated_no" name="status" value="No" onclick="showReason(true);showRest(false)"> No

                        <div id="reason_div" style="display: none;">
                            <label for="reason">Reason:</label>
                            <input type="text" id="reason" name="reason" rows="4" cols="80" placeholder="Enter reason for not being vaccinated"><br>
                        </div>

                        <div id="rest_div" style="display: none;">
                            <div class="form-field">
                                <label for="VaccinationFor">Vaccination Name:</label>
                                <input type="text" id="VaccinationFor" name="name">
                            </div>
                            <div class="form-field">
                                <label for="DoseNo">Dose number:</label>
                                <input type="number" id="DoseNo" name="dose" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>

                        </div>
                        <center>
                            <button class="btn">Submit</button>
                        </center>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script>
        function showReason(isVisible) {
            var reasonDiv = document.getElementById("reason_div");
            if (isVisible) {
                reasonDiv.style.display = "block";
            } else {
                reasonDiv.style.display = "none";
            }
        }

        function showRest(isVisible) {
            var reasonDiv = document.getElementById("rest_div");
            if (isVisible) {
                reasonDiv.style.display = "block";
            } else {
                reasonDiv.style.display = "none";
            }
        }

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
    if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['buid']) && isset($_POST['vaccine']) && isset($_POST['hid']) && isset($_POST['mydate']) && isset($_POST['ouid']) && ($_POST['vaccine'] != "")) {
        include './E_dbConnect.php';
        $buid = test_input($_POST['buid']);
        $vaccine = test_input($_POST['vaccine']);
        $hid = test_input($_POST['hid']);
        $ouid = test_input($_POST['ouid']);
        $mydate = test_input($_POST['mydate']);

        $_SESSION["thid"] = $hid;
        $_SESSION["touid"] = $ouid;
        $_SESSION["tvaccine"] = $vaccine;
        $_SESSION["tmydate"] = $mydate;
        $_SESSION["tbuid"] = $buid;

        $tempSql = "SELECT * FROM $dbname.vaccines WHERE BUID = $buid AND Date = '$mydate' AND OUID = $ouid AND HID = $hid AND Vaccine = '$vaccine';";
        if ((mysqli_num_rows(mysqli_query($conn, $tempSql))) > 0) {
    ?><script>
                showFurther(true);
            </script><?php
                    } else {
                        echo '<script>alert("Record Not Found!");</script>!';
                    }
                    mysqli_close($conn);
                }

                if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['status'])) {
                    include './E_dbConnect.php';

                    $hid = $_SESSION["thid"];
                    $ouid = $_SESSION["touid"];
                    $vaccine = $_SESSION["tvaccine"];
                    $mydate = $_SESSION["tmydate"];
                    $buid = $_SESSION["tbuid"];

                    $status = test_input($_POST['status']);
                    if (isset($_POST['name']) && isset($_POST['dose']) && !empty($_POST['dose']) && !empty($_POST['name'])) {
                        $name = test_input($_POST['name']);
                        $dose = test_input($_POST['dose']);
                        $sql = "UPDATE $dbname.vaccines SET Status = '$status', Name = '$name', Reason = NULL, Dose = $dose WHERE BUID = $buid AND Date = '$mydate' AND OUID = $ouid AND HID = $hid AND Vaccine = '$vaccine';";
                    } else {
                        $reason = test_input($_POST['reason']);
                        $sql = "UPDATE $dbname.vaccines SET Status = '$status', Name = NULL, Dose = 0, Reason = '$reason' WHERE BUID = $buid AND Date = '$mydate' AND OUID = $ouid AND HID = $hid AND Vaccine = '$vaccine';";
                    }
                    if (mysqli_query($conn, $sql)) {
                        echo '<script>alert("Vaccination record updated successfully!");</script>';
                    } else {
                        echo '<script>alert("Record Not Updated! Error: ' . mysqli_error($conn) . '.");</script>';
                    }
                    mysqli_close($conn);
                }
                        ?>

</body>

</html>