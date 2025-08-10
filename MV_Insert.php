<?php
include './M_CheckLogin.php';
include './E_dbConnect.php';
include './E_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid']) && isset($_POST['ouid']) && isset($_POST['vaccine']) && isset($_POST['status'])) {

        $buid = test_input($_POST['buid']);
        $ouid = test_input($_POST['ouid']);
        $hid = $_SESSION['hid'];

        $vaccine = test_input($_POST['vaccine']);
        $status = test_input($_POST['status']);

        try {
            if (isset($_POST['reason']) && !empty($_POST['reason'])) {
                $reason = test_input($_POST['reason']);
                $sql = "INSERT INTO $dbname.vaccines (BUID, OUID, HID, Vaccine, Status, Reason) VALUES ($buid, $ouid, $hid, '$vaccine', '$status', '$reason');";
            } else {
                $name = test_input($_POST['name']);
                $dose = test_input($_POST['dose']);
                $sql = "INSERT INTO $dbname.vaccines (BUID, OUID, HID, Vaccine, Status, Dose, Name) VALUES ($buid, $ouid, $hid, '$vaccine', '$status', $dose, '$name');";
            }

            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("New record created successfully!");</script>';
            } else {
                echo '<script>alert("Record Not Added! Error: ' . mysqli_error($conn) . '.");</script>';
            }
        } catch (Exception) {
            echo '<script>alert("Record Not Added! Record Already Exists!");</script>';
        }
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vaccination</title>
</head>

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
        margin-top: 50px;
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

<body>
    <div class="container">
        <button id="dark-mode-toggle" class="dark-mode-toggle">
            <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
                <path fill="currentColor" d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z" transform="translate(-8 -8)" />
            </svg>
        </button>
        <section id="prescription" class="record-section">
            <center>
                <h1>Vaccination Record:</h1>
            </center>
            <h3>Insert New Record:</h3>
            <p>Please enter the corresponding details.</p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-field">
                    <label for="BUID">Benificiary User ID:</label>
                    <input type="number" id="BUID" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>

                <div class="form-field">
                    <label for="OUID">Operator User ID:</label>
                    <input type="number" id="OUID" name="ouid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
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
                </script>

                <div class="col-md-5">
                    <label for="Vaccination" class="form-label">Vaccination For:</label>
                    <select class="form-select" id="Vaccination" required="" name="vaccine">
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

                <div class="form-field">
                    <label>Vaccination Status:</label>
                    <input type="radio" id="vaccinated_yes" name="status" value="Yes" onclick="showReason(false);showRest(true)"> Yes
                    <input type="radio" id="vaccinated_no" name="status" value="No" onclick="showReason(true);showRest(false)"> No

                    <div id="reason_div" style="display: none;">
                        <br>
                        <label for="reason">Reason:</label>
                        <input type="text" id="reason" name="reason" rows="4" cols="80" placeholder="Enter reason for not being vaccinated"><br>
                    </div>

                    <div id="rest_div" style="display: none;">
                        <br>
                        <div class="form-field">
                            <label for="VaccinationFor">Vaccination Name:</label>
                            <input type="text" id="VaccinationFor" name="name">
                        </div>
                        <div class="form-container">
                            <div class="form-field">
                                <label for="DoseNo">Dose number:</label>
                                <input type="number" id="DoseNo" name="dose" maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>
                        </div><br>
                    </div>
                </div>

                <br>
                <center>
                    <button class="btn" name="submit">Submit</button>
                </center>
            </form>
        </section>
        <br>
        <center><a href="./M_HealthInfo.php"><button class="btn">Go back</button></a></center>
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