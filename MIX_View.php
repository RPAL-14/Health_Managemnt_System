<?php
include './M_CheckLogin.php';
include './E_dbConnect.php';
include './E_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid']) && isset($_POST['sampleCollectionTime'])) {
        $buid = test_input($_POST['buid']);
        $sampleCollectionTime = test_input($_POST['sampleCollectionTime']);
        $_SESSION['tbuid'] = $buid;
        $sql = "SELECT * FROM $dbname.invxray WHERE BUID = $buid AND DateOfTest = '$sampleCollectionTime';";
        $result = mysqli_query($conn, $sql);
        if (isset($result) && mysqli_num_rows($result) == 0) {
            echo '<script>alert("No records found!");</script>';
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
                    <input type="number" id="BUID" value="<?php echo $_POST['buid'] ?? ''; ?>" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
                <div class="column">
                    <label for="sampleCollectionTime">Date and Time of the Test:</label>
                    <input type="datetime-local" id="sampleCollectionTime" name="sampleCollectionTime" required="" value="<?php echo $_POST['sampleCollectionTime'] ?? ''; ?>">
                </div>
            </div>
            <center>
                <input type="submit" value="Submit">
            </center>
        </form>
        <br>
        <center><a href="./M_HealthInfo.php"><input type="submit" value="Go back"></a></center>
        <br>
        <div id="data_div" style="display: block;">
            <?php
            if (isset($result) && !empty($result)) {
                if (mysqli_num_rows($result) > 0) {
                    $index = 0;
            ?>
                    <table border="1">
                        <tr>
                            <th style="font-weight: bold;">Serial Number</th>
                            <th style="font-weight: bold;">Modality</th>
                            <th style="font-weight: bold;">Part</th>
                            <th style="font-weight: bold;">Technique</th>
                            <th style="font-weight: bold;">Findings</th>
                            <th style="font-weight: bold;">Impression</th>
                            <th style="font-weight: bold;">Conclusion</th>
                            <th style="font-weight: bold;">Image</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            include './M_RetrieveXRAY.php';
                        ?>
                            <tr>
                                <?php
                                $modality = $row["Modality"];
                                $part = $row["Part"];
                                $technique = $row["Technique"];
                                $findings = $row["Findings"];
                                $impression = $row["Impression"];
                                $conclusion = $row["Conclusion"];

                                ?>

                                <td><?php $index++;
                                    echo $index ?? '-'; ?></td>
                                <td><?php echo $modality ?? '-'; ?></td>
                                <td><?php echo $part ?? '-'; ?></td>
                                <td><?php echo $technique ?? '-'; ?></td>
                                <td><?php echo $findings ?? '-'; ?></td>
                                <td><?php echo $impression ?? '-'; ?></td>
                                <td><?php echo $conclusion ?? '-'; ?></td>
                                <td><img src="<?php echo $pathtoXRAY; ?>" alt="X-RAY" width="400" height="400"></td>

                            </tr>
                        <?php
                        }
                        ?>
                    </table>
            <?php
                }
            }
            ?>
            <br>
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