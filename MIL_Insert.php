<?php
include './M_CheckLogin.php';
include './MI_Maintain.php';
include './E_dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid']) && isset($_POST['sampleouid']) && isset($_POST['reportouid']) && isset($_POST['samplecollectiontime']) && isset($_POST['ALT']) && isset($_POST['AST']) && isset($_POST['GGPT']) && isset($_POST['ALP']) && isset($_POST['totalBilirubin']) && isset($_POST['directBilirubin']) && isset($_POST['indirectBilirubin']) && isset($_POST['globulin']) && isset($_POST['totalProtein']) && isset($_POST['albumin']) && isset($_POST['AST_ALT']) && isset($_POST['agRatio'])) {

        $hid = $_SESSION['hid'];
        $sampleouid = test_input($_POST['sampleouid']);
        $reportouid = test_input($_POST['reportouid']);
        $buid = test_input($_POST['buid']);
        $samplecollectiontime = test_input($_POST['samplecollectiontime']);

        $ALT = test_input($_POST['ALT']);
        $AST = test_input($_POST['AST']);
        $GGPT = test_input($_POST['GGPT']);
        $ALP = test_input($_POST['ALP']);
        $totalBilirubin = test_input($_POST['totalBilirubin']);
        $directBilirubin = test_input($_POST['directBilirubin']);
        $indirectBilirubin = test_input($_POST['indirectBilirubin']);

        $globulin = test_input($_POST['globulin']);
        $albumin = test_input($_POST['albumin']);
        $totalProtein = test_input($_POST['totalProtein']);
        $AST_ALT = test_input($_POST['AST_ALT']);
        $agRatio = test_input($_POST['agRatio']);

        $sql = "INSERT INTO $dbname.invlft (BUID, SampleOUID, ReportOUID, SampleCollectionTime, SampleCollectionAddress, ALT, AST, GGPT, ALP, totalBilirubin,  directBilirubin, indirectBilirubin, Globulin, Albumin, totalProtein, AST_ALT, agRatio) VALUES ($buid, $sampleouid, $reportouid, '$samplecollectiontime', $hid, $ALT, $AST, $GGPT, $ALP, $totalBilirubin, $directBilirubin, $indirectBilirubin, $globulin, $albumin, $totalProtein, $AST_ALT, $agRatio);";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Investigation report generated successfully!");</script>';
        } else {
            echo '<script>alert("Record was not added! Error: ' . mysqli_error($conn) . '.");</script>';
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
    <title>LFT Blood Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(./images/Blood.png);
        }

        .container {
            max-width: 75%;
            margin: auto;
            padding: 20px;
            background-color: #f5f5f5;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .column {
            flex-basis: calc(40% - 10px);
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="datetime-local"],
        input[type="number"] {
            width: calc(90% - 20px);
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            width: 10%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h1 {
            text-align: center;
        }

        span {
            margin-left: 10px;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .column {
                flex-basis: 100%;
            }

            input[type="submit"] {
                width: 20%;
            }
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
            color: white;
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
        <h1 style="margin: 0px; margin-bottom: 15px;">LFT Blood Report</h1>
        <h3>Add the following details :</h3>
        <form id="lftForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
            <div class="row">
                <div class="column">
                    <label for="BUID">Benificiary User ID:</label>
                    <input type="number" id="BUID" name="buid" required="" maxlength="12"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
                <div class="column">
                    <label for="reportMakerUID">Report Maker UID:</label>
                    <input type="number" id="reportMakerUID" required="" maxlength="12" name="reportouid"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="sampleCollectionTime">Sample Collection Time:</label>
                    <input type="datetime-local" id="sampleCollectionTime" name="samplecollectiontime" required="">
                </div>
                <div class="column">
                    <label for="sampleCollectorUID">Sample Collector UID:</label>
                    <input type="number" id="sampleCollectorUID" name="sampleouid" required="" maxlength="12"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
            </div>

            <h3>Add the report:</h3>
            <div class="row">
                <div class="column">
                    <label for="ALT">ALT (SGPT):</label>
                    <input type="number" step="0.01" id="ALT" name="ALT" required><span>U/L</span>
                </div>
                <div class="column">
                    <label for="AST">AST (SGOT):</label>
                    <input type="number" step="0.01" id="AST" name="AST" required><span>U/L</span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="AST_ALT">AST : ALT Ratio:</label>
                    <input type="number" step="0.01" id="AST_ALT" name="AST_ALT" required>
                </div>
                <div class="column">
                    <label for="GGPT">GGPT:</label>
                    <input type="number" step="0.01" id="GGPT" name="GGPT" required><span>U/L</span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="ALP">ALP (Alkaline Phosphatase):</label>
                    <input type="number" step="0.01" id="ALP" name="ALP" required><span>U/L</span>
                </div>
                <div class="column">
                    <label for="totalBilirubin">Total Bilirubin:</label>
                    <input type="number" step="0.01" id="totalBilirubin" name="totalBilirubin"
                        required><span>mg/dL</span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="directBilirubin">Direct Bilirubin:</label>
                    <input type="number" step="0.01" id="directBilirubin" name="directBilirubin"
                        required><span>mg/dL</span>
                </div>
                <div class="column">
                    <label for="indirectBilirubin">Indirect Bilirubin:</label>
                    <input type="number" step="0.01" id="indirectBilirubin" name="indirectBilirubin"
                        required><span>mg/dL</span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="totalProtein">Total Protein:</label>
                    <input type="number" step="0.01" id="totalProtein" name="totalProtein" required><span>g/dL</span>
                </div>
                <div class="column">
                    <label for="albumin">Albumin:</label>
                    <input type="number" step="0.01" id="albumin" name="albumin" required><span>g/dL</span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="globulin">Globulin:</label>
                    <input type="number" step="0.01" id="globulin" name="globulin" required><span>g/dL</span>
                </div>
                <div class="column">
                    <label for="agRatio">A : G Ratio:</label>
                    <input type="number" step="0.01" id="agRatio" name="agRatio" required>
                </div>
            </div>
            <center>
                <input type="submit" value="Submit">
            </center>
        </form>
        <br>
        <center><a href="./M_HealthInfo.php"><input type="submit" value="Go back"></a></center>
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
