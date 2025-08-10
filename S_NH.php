<?php
include './U_CheckLogin.php';
include './E_dbConnect.php';
include './E_Validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['state']) && !empty($_POST['state'])) {
		$state = test_input($_POST['state']);
		$sql = "SELECT * FROM $dbname.hospitals WHERE State = '$state';";
		if (mysqli_query($conn, $sql)) {
			$result = mysqli_query($conn, $sql);
		} else {
			echo '<script>alert("No Hospitals Found!");</script>';
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
	<title>Find Nearby Hospitals</title>
	<link rel="icon" type="image/x-icon" href="./logo.ico">
	<link rel="stylesheet" href="style.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f2f2f2;
			background: url(./images/hospital.jpeg);
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			/* Set minimum height for viewport */
		}

		.container {
			max-width: 600px;
			margin: 0 auto;
			padding: 30px;
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			animation: fadeIn 1s ease-in-out;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
			}

			to {
				opacity: 1;
			}
		}

		h1 {
			text-align: center;
			margin-bottom: 30px;
		}

		.search-wrapper {
			display: flex;
			flex-direction: column;
			margin-bottom: 20px;
		}

		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		select {
			width: 100%;
			padding: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
			margin-bottom: 10px;
			transition: all 0.2s ease-in-out;
		}

		select:focus {
			outline: none;
			border-color: #4CAF50;
		}

		button {
			padding: 10px 20px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.2s ease-in-out;
		}

		button:hover {
			background-color: #45a049;
		}

		ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		li {
			padding: 10px 20px;
			background-color: #f9f9f9;
			margin-bottom: 5px;
			border-radius: 5px;
			transition: all 0.2s ease-in-out;
			cursor: pointer;
		}

		li:hover {
			background-color: #f2f2f2;
		}

		/* Darkmode */
        .darkmode .container{
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

        .dark-mode-toggle:hover {
            background-color: transparent;
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
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<h1>Find Nearby Hospitals</h1>
			<div class="search-wrapper">
				<label for="state">Select State:</label>
				<select id="state" name="state">
					<option value=""><?php echo $_POST['state'] ?? '-- Select State --'; ?></option>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<option value="Arunachal Pradesh">Arunachal Pradesh</option>
					<option value="Assam">Assam</option>
					<option value="Bihar">Bihar</option>
					<option value="Chhattisgarh">Chhattisgarh</option>
					<option value="Goa">Goa</option>
					<option value="Gujarat">Gujarat</option>
					<option value="Haryana">Haryana</option>
					<option value="Himachal Pradesh">Himachal Pradesh</option>
					<option value="Jharkhand">Jharkhand</option>
					<option value="Karnataka">Karnataka</option>
					<option value="Kerala">Kerala</option>
					<option value="Madhya Pradesh">Madhya Pradesh</option>
					<option value="Maharashtra">Maharashtra</option>
					<option value="Manipur">Manipur</option>
					<option value="Meghalaya">Meghalaya</option>
					<option value="Mizoram">Mizoram</option>
					<option value="Nagaland">Nagaland</option>
					<option value="Odisha">Odisha</option>
					<option value="Punjab">Punjab</option>
					<option value="Rajasthan">Rajasthan</option>
					<option value="Sikkim">Sikkim</option>
					<option value="Tamil Nadu">Tamil Nadu</option>
					<option value="Telangana">Telangana</option>
					<option value="Tripura">Tripura</option>
					<option value="Uttar Pradesh">Uttar Pradesh</option>
					<option value="Uttarakhand">Uttarakhand</option>
					<option value="West Bengal">West Bengal</option>
					<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
					<option value="Chandigarh">Chandigarh</option>
					<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
					<option value="Daman and Diu">Daman and Diu</option>
					<option value="Delhi">Delhi</option>
					<option value="Lakshadweep">Lakshadweep</option>
					<option value="Puducherry">Puducherry</option>
				</select>
				<center>
					<button id="showHospitalsBtn" type="submit" style="margin: 10px;">Find Hospitals</button>
					<a href="./U_AfterLogin.php"><button type="button">Go Back</button></a>
				</center>

			</div>
		</form>

		<div id="data_div" style="display: block;">
			<?php
			if (isset($result) && !empty($result)) {
				if (mysqli_num_rows($result) > 0) {
					$index = 0;
			?>
					<table border="1">
						<tr>
							<th style="font-weight: bold;">Serial Number</th>
							<th style="font-weight: bold;">Name</th>
							<th style="font-weight: bold;">District</th>
							<th style="font-weight: bold;">Contact information</th>
							<th style="font-weight: bold;">Bed Capacity</th>
						</tr>
						<?php
						while ($row = mysqli_fetch_assoc($result)) {
						?>
							<tr>
								<?php
								$name = $row["Name"];
								$district = $row["District"] . ", " . $row["State"] . ".";
								$contact = $row["Contact"];
								$bedcapacity = $row["BedCapacity"];
								?>
								<td><?php $index++;
									echo $index ?? '-'; ?></td>
								<td><?php echo $name ?? '-'; ?></td>
								<td><?php echo $district ?? '-'; ?></td>
								<td><?php echo $contact ?? '-'; ?></td>
								<td><?php echo $bedcapacity ?? '-'; ?></td>
							</tr>
						<?php
						}
						?>
					</table><?php
						}
					}
							?>
			<br>
		</div>
	</div>

	<script>
		const stateDropdown = document.getElementById("state");
		const hospitalList = document.getElementById("hospital");

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