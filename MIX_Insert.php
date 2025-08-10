<?php
include './M_CheckLogin.php';
include './MI_Maintain.php';
include './E_dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid']) && isset($_POST['ouid']) && isset($_POST['modality']) && isset($_POST['part']) && isset($_POST['technique']) && isset($_POST['findings']) && isset($_POST['impression']) && isset($_POST['conclusion']) && isset($_FILES['image'])) {

        $ouid = test_input($_POST['ouid']);
        $buid = test_input($_POST['buid']);
        $hid = $_SESSION['hid'];

        $modality = test_input($_POST['modality']);
        $part = test_input($_POST['part']);
        $technique = test_input($_POST['technique']);
        $findings = test_input($_POST['findings']);
        $impression = test_input($_POST['impression']);
        $conclusion = test_input($_POST['conclusion']);

        date_default_timezone_set("Asia/Calcutta");
        $dateoftest = date("Y/m/d H:i");
        $dateoftest = $dateoftest . ":00";

        $imagePath = './' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        $pythonScript = './E_DTP.py';
        $pythonPath = "C:\\Users\\gargm\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";
        $output = exec("$pythonPath $pythonScript $imagePath");

        if ($output != "Image converted successfully!") {
            echo '<script>alert("Python script execution failed!");</script>';
        } else if (!file_exists('./sample.png')) {
            echo '<script>alert("sample.png was not created!");</script>';
        } else {

            $image = base64_encode(file_get_contents('./sample.png'));
            if (file_exists('./sample.png')) {
                unlink('./sample.png');
            }

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $stmt = $conn->prepare("INSERT INTO $dbname.invxray (BUID, OUID, HID, DateOfTest, Image, Modality, Part, Technique, Findings, Impression, Conclusion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiissssssss", $buid, $ouid, $hid, $dateoftest, $image, $modality, $part, $technique, $findings, $impression, $conclusion);

            if ($stmt->execute()) {
                echo '<script>alert("Investigation report generated successfully!");</script>';
            } else {
                echo '<script>alert("Record Not Added! Please try again.");</script>';
            }
            $stmt->close();
        }
    }
}
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
        input[type="number"] {
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
                    <input type="number" id="BUID" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
                <div class="column">
                    <label for="Operator ID">Operator ID:</label>
                    <input type="number" name="ouid" id="OID" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
            </div>
            <h3>Add the Report :</h3>
            <div class="row">
                <div class="column">
                    <label for="modality">Modality:</label>
                    <input type="text" id="modality" name="modality" required>
                </div>
                <div class="column">
                    <label for="part">Part:</label>
                    <input type="text" id="part" name="part" required>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="technique">Technique:</label>
                    <input type="text" id="technique" name="technique" required>
                </div>
                <div class="column">
                    <label for="findings">Findings:</label>
                    <input type="text" id="findings" name="findings" required>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="impression">Impression:</label>
                    <input type="text" id="impression" name="impression" required>
                </div>
                <div class="column">
                    <label for="conclusion">Conclusion:</label>
                    <input type="text" id="conclusion" name="conclusion" required>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="file" class="custom-file-upload">
                        <span id="file-label">Choose File</span>
                        <input type="file" id="file" name="image" accept="image/*" required style="display:none;" onchange="updateFileLabel()">
                    </label>
                </div>
            </div>

            <center>
                <input type="submit" value="Submit">
            </center>
        </form>
        <br>
        <center>
            <a href="./M_HealthInfo.php"><input type="submit" value="Go back"></a>
        </center>
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