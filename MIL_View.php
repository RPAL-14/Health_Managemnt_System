<?php
include './M_CheckLogin.php';
include './MI_Maintain.php';
include './E_dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buid']) && isset($_POST['samplecollectiontime'])) {

        $buid = test_input($_POST['buid']);
        $samplecollectiontime = test_input($_POST['samplecollectiontime']);
        $sql = "SELECT * FROM $dbname.invlft WHERE BUID = $buid AND SampleCollectionTime = '$samplecollectiontime';";

        $result = mysqli_query($conn, $sql);
        if (isset($result) && mysqli_num_rows($result) == 0) {
            echo '<script>alert("No records found!");</script>';
        }
        mysqli_close($conn);
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Records</title>
    <link rel="icon" type="image/x-icon" href="./logo.ico">
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

        input[type="datetime-local"],
        input[type="number"] {
            width: calc(50% - 20px);
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            width: 10%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
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
        <center>
            <h1 style="margin: 0px; margin-bottom: 15px;">LFT Blood Report</h1>
            <h2>Enter your details below:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-container">
                    <div class="form-field">
                        <label for="BUID">Benificiary Unique ID:</label>
                        <input type="number" id="BUID" name="buid" required="" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $_POST['buid'] ?? ''; ?>">
                    </div>

                    <div class="form-field">
                        <label for="followUpDate">Sample Collection Time:</label>
                        <input type="datetime-local" id="followUpDate" name="samplecollectiontime" value="<?php echo $_POST['samplecollectiontime'] ?? ''; ?>">
                    </div>
                    <button class="btn btn-success" type="submit">View</button>
                </div>
            </form>
            <br>
            <a href="./M_HealthInfo.php"><button class="w-20 btn btn-success btn-lg my-3">Go back</button></a>

            <br>
            <div id="data_div" style="display: block;">
                <?php
                if (isset($result) && !empty($result)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $samplecollectiontime = $row['SampleCollectionTime'];
                            $reportgenerated = $row['ReportGenerated'];
                            $ALT = $row['ALT'];
                            $AST = $row['AST'];
                            $GGPT = $row['GGPT'];
                            $ALP = $row['ALP'];
                            $totalBilirubin = $row['totalBilirubin'];
                            $directBilirubin = $row['directBilirubin'];
                            $indirectBilirubin = $row['indirectBilirubin'];

                            $globulin = $row['Globulin'];
                            $albumin = $row['Albumin'];
                            $totalProtein = $row['totalProtein'];
                            $AST_ALT = $row['AST_ALT'];
                            $agRatio = $row['agRatio'];
                ?>

                            <p>Sample Collection Time: <?php echo $samplecollectiontime ?? '-'; ?></p>
                            <p>Report Generation Time: <?php echo $reportgenerated ?? '-'; ?></p>
                            <table border="1">
                                <tr>
                                    <th style="font-weight: bold;">Serial Number</th>
                                    <th style="font-weight: bold;">Parameter</th>
                                    <th style="font-weight: bold;">Value</th>
                                    <th style="font-weight: bold;">Reference Value</th>
                                    <th style="font-weight: bold;">Unit</th>
                                    <th style="font-weight: bold;">Status</th>
                                </tr>


                                <tr>
                                    <td><?php echo '1'; ?></td>
                                    <td><?php echo 'ALT (SGPT)' ?></td>
                                    <td><?php echo $ALT ?? '-'; ?></td>
                                    <td><?php echo '15.00 - 40.00'; ?></td>
                                    <td><?php echo 'U/L'; ?></td>

                                    <?php
                                    if ($ALT > 40) {
                                        $status = 'High';
                                    } elseif ($ALT < 15) {
                                        $status = 'Low';
                                    } else {
                                        $status = 'Within Limit';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '2'; ?></td>
                                    <td><?php echo 'AST (SGOT)' ?></td>
                                    <td><?php echo $AST ?? '-'; ?></td>
                                    <td><?php echo '10.00 - 49.00'; ?></td>
                                    <td><?php echo 'U/L'; ?></td>

                                    <?php
                                    if ($AST > 49) {
                                        $status = 'High';
                                    } elseif ($AST < 10) {
                                        $status = 'Low';
                                    } else {
                                        $status = 'Within Limit';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '3'; ?></td>
                                    <td><?php echo 'AST : ALT Ratio' ?></td>
                                    <td><?php echo $AST_ALT ?? '-'; ?></td>
                                    <td><?php echo '< 1.00'; ?></td>
                                    <td><?php echo '-'; ?></td>

                                    <?php
                                    if ($AST_ALT < 1.00) {
                                        $status = 'Within Limit';
                                    } else {
                                        $status = 'High';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '4'; ?></td>
                                    <td><?php echo 'GGPT' ?></td>
                                    <td><?php echo $GGPT ?? '-'; ?></td>
                                    <td><?php echo '00.00 - 73.00'; ?></td>
                                    <td><?php echo 'U/L'; ?></td>

                                    <?php
                                    if ($GGPT > 73.00) {
                                        $status = 'High';
                                    } elseif ($GGPT < 00.00) {
                                        $status = 'Low';
                                    } else {
                                        $status = 'Within Limit';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '5'; ?></td>
                                    <td><?php echo 'ALP (Alkaline Phosphatase)' ?></td>
                                    <td><?php echo $ALP ?? '-'; ?></td>
                                    <td><?php echo '30.00 - 120.00'; ?></td>
                                    <td><?php echo 'U/L'; ?></td>

                                    <?php
                                    if ($ALP > 120) {
                                        $status = 'High';
                                    } elseif ($ALP < 30) {
                                        $status = 'Low';
                                    } else {
                                        $status = 'Within Limit';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '6'; ?></td>
                                    <td><?php echo 'Total Bilirubin' ?></td>
                                    <td><?php echo $totalBilirubin ?? '-'; ?></td>
                                    <td><?php echo '0.30 - 1.20'; ?></td>
                                    <td><?php echo 'mg/dL'; ?></td>

                                    <?php
                                    if ($totalBilirubin > 1.20) {
                                        $status = 'High';
                                    } elseif ($totalBilirubin < 0.30) {
                                        $status = 'Low';
                                    } else {
                                        $status = 'Within Limit';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '7'; ?></td>
                                    <td><?php echo 'Direct Bilirubin' ?></td>
                                    <td><?php echo $directBilirubin ?? '-'; ?></td>
                                    <td><?php echo '< 0.3'; ?></td>
                                    <td><?php echo 'mg/dL'; ?></td>

                                    <?php
                                    if ($directBilirubin < 0.3) {
                                        $status = 'Within Limit';
                                    } else {
                                        $status = 'High';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '8'; ?></td>
                                    <td><?php echo 'Indirect Bilirubin' ?></td>
                                    <td><?php echo $indirectBilirubin ?? '-'; ?></td>
                                    <td><?php echo '< 1.10'; ?></td>
                                    <td><?php echo 'mg/dL'; ?></td>

                                    <?php
                                    if ($indirectBilirubin < 1.10) {
                                        $status = 'Within Limit';
                                    } else {
                                        $status = 'High';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '9'; ?></td>
                                    <td><?php echo 'Total Protein' ?></td>
                                    <td><?php echo $totalProtein ?? '-'; ?></td>
                                    <td><?php echo '5.70 - 8.20'; ?></td>
                                    <td><?php echo 'g/dL'; ?></td>

                                    <?php
                                    if ($totalProtein > 8.20) {
                                        $status = 'High';
                                    } elseif ($totalProtein < 5.70) {
                                        $status = 'Low';
                                    } else {
                                        $status = 'Within Limit';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '10'; ?></td>
                                    <td><?php echo 'Albumin' ?></td>
                                    <td><?php echo $albumin ?? '-'; ?></td>
                                    <td><?php echo '3.20 - 4.80'; ?></td>
                                    <td><?php echo 'g/dL'; ?></td>

                                    <?php
                                    if ($albumin > 4.80) {
                                        $status = 'High';
                                    } elseif ($albumin < 3.20) {
                                        $status = 'Low';
                                    } else {
                                        $status = 'Within Limit';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '11'; ?></td>
                                    <td><?php echo 'Globulin' ?></td>
                                    <td><?php echo $globulin ?? '-'; ?></td>
                                    <td><?php echo '2.00 - 3.50'; ?></td>
                                    <td><?php echo 'g/dL'; ?></td>

                                    <?php
                                    if ($globulin > 3.50) {
                                        $status = 'High';
                                    } elseif ($globulin < 2.00) {
                                        $status = 'Low';
                                    } else {
                                        $status = 'Within Limit';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo '12'; ?></td>
                                    <td><?php echo 'A : G Ratio' ?></td>
                                    <td><?php echo $agRatio ?? '-'; ?></td>
                                    <td><?php echo '0.90 - 2.00'; ?></td>
                                    <td><?php echo '-'; ?></td>

                                    <?php
                                    if ($agRatio > 2.00) {
                                        $status = 'High';
                                    } elseif ($agRatio < 0.90) {
                                        $status = 'Low';
                                    } else {
                                        $status = 'Within Limit';
                                    }
                                    ?>
                                    <td><?php echo $status ?? '-'; ?></td>
                                </tr>

                            </table>
                <?php
                        }
                    }
                }
                ?>
                <br>
            </div>
        </center>
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