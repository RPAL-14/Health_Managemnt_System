<?php
include './M_CheckLogin.php';
include './MI_Maintain.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-ray Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(./images/Xray.png);
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
        input[type="number"],
        input[type="datetime-local"] {
            width: calc(100% - 20px);
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

        .custom-file-upload {
            display: inline-block;
            cursor: pointer;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }

        .custom-file-upload:hover {
            background-color: #45a049;
        }

        #file-label {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
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
        <h1 style="margin: 0px; margin-bottom: 15px;">X-ray Report</h1>
        <h3>Add your details :</h3>
        <form id="lftForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="column">
                    <label for="BUID">Benificiary User ID:</label>
                    <input type="number" id="BUID" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $_POST['buid'] ?? ''; ?>">
                </div>
                <div class="column">
                    <label for="sampleCollectionTime">Date and Time of the Test:</label>
                    <input type="datetime-local" id="sampleCollectionTime" name="sampleCollectionTime" required="" value="<?php echo $_POST['sampleCollectionTime'] ?? ''; ?>">
                </div>
                <div class="column">
                    <label for="Operator ID">Operator ID:</label>
                    <input type="number" name="ouid" id="OID" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $_POST['ouid'] ?? ''; ?>">
                </div>
                <div class="column">
                    <label for="sampleCollectedAddress">Hospital ID (where test was conducted):</label>
                    <input type="number" id="hid" name="hid" required="" value="<?php echo $_POST['hid'] ?? ''; ?>">
                </div>
            </div>
            <center>
                <input type="submit" value="Submit">
            </center>
        </form>
        <br>
        <center><a href="./M_HealthInfo.php"><input type="submit" value="Go back"></a></center>
        <br>
        <div id="data_div" style="display: none;">
            <form id="lftForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <h3>Report Found!<br>Add the Report :</h3>
                <div class="row">
                    <div class="column">
                        <label for="modality">Modality:</label>
                        <input type="text" id="modality" name="modality">
                    </div>
                    <div class="column">
                        <label for="part">Part:</label>
                        <input type="text" id="part" name="part">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="technique">Technique:</label>
                        <input type="text" id="technique" name="technique">
                    </div>
                    <div class="column">
                        <label for="findings">Findings:</label>
                        <input type="text" id="findings" name="findings">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="impression">Impression:</label>
                        <input type="text" id="impression" name="impression">
                    </div>
                    <div class="column">
                        <label for="conclusion">Conclusion:</label>
                        <input type="text" id="conclusion" name="conclusion">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="file" class="custom-file-upload" style="margin-left: 10px;">
                            <span id="file-label">Choose File</span>
                            <input type="file" id="file" name="image" accept="image/*" style="display:none;" onchange="updateFileLabel()">
                        </label>
                    </div>
                </div>

                <center><input type="submit" name="tUpdate" value="Update"></center>
            </form>
        </div>
    </div>

    <script>
        function updateFileLabel() {
            var fileInput = document.getElementById('file');
            var fileLabel = document.getElementById('file-label');
            if (fileInput.files.length > 0) {
                fileLabel.textContent = fileInput.files[0].name;
            } else {
                fileLabel.textContent = 'Choose File';
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
    </script>

    <?php
    if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['buid']) && isset($_POST['ouid']) && isset($_POST['hid']) && isset($_POST['sampleCollectionTime'])) {

        include './E_dbConnect.php';
        $ouid = test_input($_POST['ouid']);
        $buid = test_input($_POST['buid']);
        $hid = test_input($_POST['hid']);
        $sampleCollectionTime = test_input($_POST['sampleCollectionTime']);

        $_SESSION['tbuid'] = $buid;
        $_SESSION['touid'] = $ouid;
        $_SESSION['thid'] = $hid;
        $_SESSION['tsample'] = $sampleCollectionTime;

        $tempSql = "SELECT * FROM $dbname.invxray WHERE BUID = $buid AND OUID = $ouid AND HID = $hid AND DateOfTest = '$sampleCollectionTime';";

        if ((mysqli_num_rows(mysqli_query($conn, $tempSql))) > 0) {
    ?><script>
                showFurther(true);
            </script><?php
                    } else {
                        echo '<script>alert("Record Not Found!");</script>!';
                    }
                    mysqli_close($conn);
                }

                if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['tUpdate'])) {

                    include './E_dbConnect.php';
                    $flag = true;
                    $buid = $_SESSION['tbuid'];
                    $ouid = $_SESSION['touid'];
                    $hid = $_SESSION['thid'];
                    $sampleCollectionTime = $_SESSION['tsample'];

                    function addData($conn, $sql)
                    {
                        if (mysqli_query($conn, $sql) == false) {
                            echo '<script>alert("Record Not Updated! Error: ' . mysqli_error($conn) . '.");</script>';
                            $_GLOBALS['flag'] = false;
                        }
                    }

                    if (isset($_POST['modality']) && !empty($_POST['modality']) && ($_POST['modality'] != null)) {
                        $modality = test_input($_POST['modality']);
                        $sql = "UPDATE $dbname.invxray SET Modality = '$modality' WHERE BUID = $buid AND OUID = $ouid AND HID = $hid AND DateOfTest = '$sampleCollectionTime';";
                        addData($conn, $sql);
                    }

                    if (isset($_FILES['image']) && ($_FILES['image']['error'] == 0)) {
                        $imagePath = './' . basename($_FILES['image']['name']);
                        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
                        $pythonScript = './E_DTP.py';
                        $pythonPath = "C:\\Users\\gargm\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";
                        $output = exec("$pythonPath $pythonScript $imagePath");

                        if ($output != "Image converted successfully!") {
                            echo '<script>alert("Python script execution failed!");</script>';
                            $_GLOBALS['flag'] = false;
                        } else if (!file_exists('./sample.png')) {
                            echo '<script>alert("sample.png was not created!");</script>';
                            $_GLOBALS['flag'] = false;
                        } else {
                            $image = base64_encode(file_get_contents('./sample.png'));
                            if (file_exists('./sample.png')) {
                                unlink('./sample.png');
                            }

                            if (file_exists($imagePath)) {
                                unlink($imagePath);
                            }

                            $sql = "UPDATE $dbname.invxray SET Image = '$image' WHERE BUID = $buid AND OUID = $ouid AND HID = $hid AND DateOfTest = '$sampleCollectionTime';";
                            addData($conn, $sql);
                        }
                    }

                    if (isset($_POST['part']) && !empty($_POST['part']) && ($_POST['part'] != null)) {
                        $part = test_input($_POST['part']);
                        $sql = "UPDATE $dbname.invxray SET Part = '$part' WHERE BUID = $buid AND OUID = $ouid AND HID = $hid AND DateOfTest = '$sampleCollectionTime';";
                        addData($conn, $sql);
                    }

                    if (isset($_POST['technique']) && !empty($_POST['technique']) && ($_POST['technique'] != null)) {
                        $technique = test_input($_POST['technique']);
                        $sql = "UPDATE $dbname.invxray SET Technique = '$technique' WHERE BUID = $buid AND OUID = $ouid AND HID = $hid AND DateOfTest = '$sampleCollectionTime';";
                        addData($conn, $sql);
                    }

                    if (isset($_POST['conclusion']) && !empty($_POST['conclusion']) && ($_POST['conclusion'] != null)) {
                        $conclusion = test_input($_POST['conclusion']);
                        $sql = "UPDATE $dbname.invxray SET Conclusion = '$conclusion' WHERE BUID = $buid AND OUID = $ouid AND HID = $hid AND DateOfTest = '$sampleCollectionTime';";
                        addData($conn, $sql);
                    }

                    if (isset($_POST['impression']) && !empty($_POST['impression']) && ($_POST['impression'] != null)) {
                        $impression = test_input($_POST['impression']);
                        $sql = "UPDATE $dbname.invxray SET Impression = '$impression' WHERE BUID = $buid AND OUID = $ouid AND HID = $hid AND DateOfTest = '$sampleCollectionTime';";
                        addData($conn, $sql);
                    }

                    if (isset($_POST['findings']) && !empty($_POST['findings']) && ($_POST['findings'] != null)) {
                        $findings = test_input($_POST['findings']);
                        $sql = "UPDATE $dbname.invxray SET Findings = '$findings' WHERE BUID = $buid AND OUID = $ouid AND HID = $hid AND DateOfTest = '$sampleCollectionTime';";
                        addData($conn, $sql);
                    }

                    if ($flag) {
                        echo '<script>alert("Record updated successfully!");</script>';
                    }
                    mysqli_close($conn);
                }
                        ?>

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