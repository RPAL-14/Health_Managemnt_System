<?php
include './U_CheckLogin.php';
include './E_dbConnect.php';
include './E_Validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['request'])) {

        $uid = $_SESSION["userUID"];
        $request = test_input($_POST['request']);

        if (isset($_POST['bloodGroup']) && (isset($_POST['bloodGroup']) == "")) {
            $bloodGroup = test_input($_POST['bloodGroup']);
            $sql = "INSERT INTO $dbname.btrequest (UID, Type, Specification) VALUES ($uid, '$request', '$bloodGroup');";
        } else {
            $organ = test_input($_POST['organ']);
            $sql = "INSERT INTO $dbname.btrequest (UID, Type, Specification) VALUES ($uid, '$request', '$organ');";
        }

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Your request has been accepted. We will revert soon.");</script>';
        } else {
            echo '<script>alert("Your request was not received! Error: '.mysqli_error($conn).'.");</script>';
        }
        mysqli_close($conn);
?>
        <script>
            window.location.href = "http://localhost/hms/u_afterlogin.php";
        </script>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request for Blood / Transplant</title>
	<link rel="icon" type="image/x-icon" href="./logo.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('./images/Blood\ Donation.jpeg');
            background-size: cover;
            background-position: center;
        }

        .container {
            max-width: 600px;
            margin: 120px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
        }
    </style>
</head>

<body>
    
    <div class="container">
        <h2>Request for Blood / Transplant</h2>
        <form id="bloodDonorForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label>Type of Request:</label>
            <input type="radio" id="vaccinated_yes" name="request" value="Blood" onclick="showBlood(true); showOrgan(false)"> Blood
            <input type="radio" id="vaccinated_no" name="request" value="Transplant" onclick="showOrgan(true); showBlood(false)"> Transplant

            <br><br>
            <div id="blood_div" style="display: none;">
                <label for="bloodGroup">Blood Group:</label>
                <select id="bloodGroup" name="bloodGroup">
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>

            <div id="organ_div" style="display: none;">
                <label for="bloodGroup">Transplant:</label>
                <select id="bloodGroup" name="organ">
                    <option value="Heart">Heart</option>
                    <option value="Kidney">Kidney</option>
                    <option value="Liver">Liver</option>
                    <option value="Lungs">Lungs</option>
                    <option value="Pancreas">Pancreas</option>
                    <option value="Intestines">Intestines</option>
                    <option value="Skin_Tissue">Skin Tissue</option>
                    <option value="Bone_Tissue">Bone Tissue</option>
                    <option value="Eye_Tissue">Eye Tissue</option>
                    <option value="Heart_Valves">Heart Valves</option>
                    <option value="Blood_Vessels">Heart Blood Vessels</option>
                </select>
            </div>

            <center>
                <button type="submit" style="margin: 10px;">Place Request</button>    
                <a href="./U_AfterLogin.php"><button type="button" style="margin: 10px;">Go Back</button></a>
            </center>

        </form>
        <div id="donorResult"></div>
    </div>

    <script>
        function showBlood(isVisible) {
            var reasonDiv = document.getElementById("blood_div");
            if (isVisible) {
                reasonDiv.style.display = "block";
            } else {
                reasonDiv.style.display = "none";
            }
        }

        function showOrgan(isVisible) {
            var reasonDiv = document.getElementById("organ_div");
            if (isVisible) {
                reasonDiv.style.display = "block";
            } else {
                reasonDiv.style.display = "none";
            }
        }
    </script>
</body>
</html>