<?php
include './M_CheckLogin.php';
include './MI_Maintain.php';
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
            margin-top: 20px;
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
        <form id="lftForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="row">
                <div class="column">
                    <label for="BUID">Benificiary User ID:</label>
                    <input type="number" id="BUID" name="buid" required="" value="<?php echo $_POST['buid'] ?? ''; ?>" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
                <div class="column">
                    <label for="sampleCollectionAddress">Hospital ID (where sample was collected):</label>
                    <input type="number" value="<?php echo $_POST['samplecollectionaddress'] ?? ''; ?>" id="sampleCollectionAddress" name="samplecollectionaddress" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="sampleCollectionTime">Sample Collection Time:</label>
                    <input type="datetime-local" id="sampleCollectionTime" value="<?php echo $_POST['samplecollectiontime'] ?? ''; ?>" name="samplecollectiontime" required="">
                </div>
                <div class="column">
                    <label for="sampleCollectorUID">Sample Collector UID:</label>
                    <input type="number" id="sampleCollectorUID" value="<?php echo $_POST['sampleouid'] ?? ''; ?>" name="sampleouid" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="reportMakerUID">Report Maker UID:</label>
                    <input type="number" id="reportMakerUID" maxlength="12" value="<?php echo $_POST['reportouid'] ?? ''; ?>" name="reportouid" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
            </div>
            <center>
                <input type="submit" value="Submit">
            </center>
        </form>
        <br>
        <center>
            <a href="./M_HealthInfo.php"><input type="submit" value="Go Back"></a>
        </center>
        <br>
        <script>
            function showFurther(isVisible) {
                var reasonDiv = document.getElementById("data_div");
                if (isVisible) {
                    reasonDiv.style.display = "block";
                } else {
                    reasonDiv.style.display = "none";
                }
            }
        </script>

        <div id="data_div" style="display: none;">
            <form id="lftForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h3>Record Found!<br>Update the report:</h3>

                <div class="row">
                    <div class="column">
                        <label for="ALT">ALT (SGPT):</label>
                        <input type="number" step="0.01" id="ALT" name="ALT"><span>U/L</span>
                    </div>
                    <div class="column">
                        <label for="AST">AST (SGOT):</label>
                        <input type="number" step="0.01" id="AST" name="AST"><span>U/L</span>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="AST_ALT">AST : ALT Ratio:</label>
                        <input type="number" step="0.01" id="AST_ALT" name="AST_ALT">
                    </div>
                    <div class="column">
                        <label for="GGPT">GGPT:</label>
                        <input type="number" step="0.01" id="GGPT" name="GGPT"><span>U/L</span>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="ALP">ALP (Alkaline Phosphatase):</label>
                        <input type="number" step="0.01" id="ALP" name="ALP"><span>U/L</span>
                    </div>
                    <div class="column">
                        <label for="totalBilirubin">Total Bilirubin:</label>
                        <input type="number" step="0.01" id="totalBilirubin" name="totalBilirubin"><span>mg/dL</span>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="directBilirubin">Direct Bilirubin:</label>
                        <input type="number" step="0.01" id="directBilirubin" name="directBilirubin"><span>mg/dL</span>
                    </div>
                    <div class="column">
                        <label for="indirectBilirubin">Indirect Bilirubin:</label>
                        <input type="number" step="0.01" id="indirectBilirubin" name="indirectBilirubin"><span>mg/dL</span>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="totalProtein">Total Protein:</label>
                        <input type="number" step="0.01" id="totalProtein" name="totalProtein"><span>g/dL</span>
                    </div>
                    <div class="column">
                        <label for="albumin">Albumin:</label>
                        <input type="number" step="0.01" id="albumin" name="albumin"><span>g/dL</span>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="globulin">Globulin:</label>
                        <input type="number" step="0.01" id="globulin" name="globulin"><span>g/dL</span>
                    </div>
                    <div class="column">
                        <label for="agRatio">A : G Ratio:</label>
                        <input type="number" step="0.01" id="agRatio" name="agRatio">
                    </div>
                </div>
                <center><input type="submit" value="Update" name="tsubmit"></center>
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
    </script>

    <?php
    if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['samplecollectionaddress']) && isset($_POST['reportouid']) && isset($_POST['sampleouid']) && isset($_POST['buid']) && isset($_POST['samplecollectiontime']) && !empty($_POST['samplecollectionaddress']) && !empty($_POST['reportouid']) && !empty($_POST['sampleouid']) && !empty($_POST['buid']) && !empty($_POST['samplecollectiontime'])) {

        include './E_dbConnect.php';
        $samplecollectionaddress = test_input($_POST['samplecollectionaddress']);
        $reportouid = test_input($_POST['reportouid']);
        $sampleouid = test_input($_POST['sampleouid']);
        $samplecollectiontime = test_input($_POST['samplecollectiontime']);
        $buid = test_input($_POST['buid']);

        $_SESSION["tsamplecollectionaddress"] = $samplecollectionaddress;
        $_SESSION["treportouid"] = $reportouid;
        $_SESSION["tsampleouid"] = $sampleouid;
        $_SESSION["tsamplecollectiontime"] = $samplecollectiontime;
        $_SESSION["tbuid"] = $buid;

        $tempSql = "SELECT * FROM $dbname.invlft WHERE BUID = $buid AND SampleOUID = $sampleouid AND ReportOUID = $reportouid AND SampleCollectionAddress = $samplecollectionaddress AND SampleCollectionTime = '$samplecollectiontime';";

        if ((mysqli_num_rows(mysqli_query($conn, $tempSql))) > 0) {
    ?><script>
                showFurther(true);
            </script><?php
                    } else {
                        echo '<script>alert("Record Not Found!");</script>!';
                    }
                    mysqli_close($conn);
                }

                if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['tsubmit'])) {
                    include './E_dbConnect.php';
                    $samplecollectionaddress = $_SESSION["tsamplecollectionaddress"];
                    $reportouid = $_SESSION["treportouid"];
                    $sampleouid = $_SESSION["tsampleouid"];
                    $samplecollectiontime = $_SESSION["tsamplecollectiontime"];
                    $buid = $_SESSION["tbuid"];
                    $flag = true;

                    function addData($conn, $sql)
                    {
                        if (!(mysqli_query($conn, $sql))) {
                            echo '<script>alert("Record Not Updated! Error: ' . mysqli_error($conn) . '.");</script>';
                            $flag = false;
                        }
                    }

                    if ($_POST['ALT'] != null) {
                        $ALT = test_input($_POST['ALT']);
                        $sql = "UPDATE $dbname.invlft SET ALT = $ALT WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['AST'] != null) {
                        $AST = test_input($_POST['AST']);
                        $sql = "UPDATE $dbname.invlft SET AST = $AST WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['ALP'] != null) {
                        $ALP = test_input($_POST['ALP']);
                        $sql = "UPDATE $dbname.invlft SET ALP = $ALP WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['GGPT'] != null) {
                        $GGPT = test_input($_POST['GGPT']);
                        $sql = "UPDATE $dbname.invlft SET GGPT = $GGPT WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['totalBilirubin'] != null) {
                        $totalBilirubin = test_input($_POST['totalBilirubin']);
                        $sql = "UPDATE $dbname.invlft SET totalBilirubin = $totalBilirubin WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['directBilirubin'] != null) {
                        $directBilirubin = test_input($_POST['directBilirubin']);
                        $sql = "UPDATE $dbname.invlft SET directBilirubin = $directBilirubin WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['indirectBilirubin'] != null) {
                        $indirectBilirubin = test_input($_POST['indirectBilirubin']);
                        $sql = "UPDATE $dbname.invlft SET indirectBilirubin = $indirectBilirubin WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }

                    if ($_POST['totalProtein'] != null) {
                        $totalProtein = test_input($_POST['totalProtein']);
                        $sql = "UPDATE $dbname.invlft SET totalProtein = $totalProtein WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['globulin'] != null) {
                        $globulin = test_input($_POST['globulin']);
                        $sql = "UPDATE $dbname.invlft SET Globulin = $globulin WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['albumin'] != null) {
                        $albumin = test_input($_POST['albumin']);
                        $sql = "UPDATE $dbname.invlft SET Albumin = $albumin WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['agRatio'] != null) {
                        $agRatio = test_input($_POST['agRatio']);
                        $sql = "UPDATE $dbname.invlft SET agRatio = $agRatio WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($_POST['AST_ALT'] != null) {
                        $AST_ALT = test_input($_POST['AST_ALT']);
                        $sql = "UPDATE $dbname.invlft SET AST_ALT = $AST_ALT WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime' AND SampleCollectionAddress = $samplecollectionaddress AND SampleOUID = $sampleouid AND ReportOUID = $reportouid;";
                        addData($conn, $sql);
                    }
                    if ($flag) {
                        echo '<script>alert("Record updated successfully!");</script>';
                    }
                    mysqli_close($conn);
                }
                        ?>
</body>

</html>