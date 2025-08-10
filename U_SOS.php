<?php
include './U_CheckLogin.php';
include './E_dbConnect.php';
include './E_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['contact_no']) && isset($_POST['address']) && isset($_POST['other'])) {
        $uid = $_SESSION['userUID'];
        $name = test_input($_POST['name']);
        $contact_no = test_input($_POST['contact_no']);
        $address = test_input($_POST['address']);
        $other = test_input($_POST['other']);
        $sql = "INSERT INTO $dbname.onlinesos (UID, Name, Contact, Address, Additional_Info) VALUES ($uid, '$name', '$contact_no', '$address', '$other');";

        try {
            if (mysqli_query($conn, $sql)) {
?><script>
                    alert("Your message has been received! Dispatching respond units.")
                </script><?php
                        }
                    } catch (Exception) {
                            ?><script>
                alert("Your message was not delivered.")
            </script><?php
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
    <title>Swasth Bharat Pranali - SOS Form</title>
    <link rel="icon" type="image/x-icon" href="./logo.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(./images/SOS.png);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 10px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        label,
        input,
        textarea {
            display: block;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Darkmode */
        .darkmode .container {
            background-color: #2B2B2B;
            color: white;
        }

        .darkmode {
            background-color: #2B2B2B;
            color: white;
        }

        .darkmode p {
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
    </style>
</head>

<body>
    <div>
        <button id="dark-mode-toggle" class="dark-mode-toggle">
            <svg style="top: 50%; left: 50%; transform: translate(-50%, -70%); position: relative;" width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
                <path fill="currentColor" d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z" transform="translate(-8 -8)" />
            </svg>
        </button>

        <div class="container" style="display:flex; justify-content: center; align-items: center; color:white; background-color: #2D9596;">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="60" fill="currentColor" class="bi bi-heart-pulse" viewBox="0 0 16 16" style="margin: 10px;">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857q.09.083.176.171a3 3 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01zM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5" />
                <path d="M10.464 3.314a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162z" />
            </svg>
            <h1>Swasth Bharat Pranali</h1>
        </div>
        <div class="col-md-7 col-lg-8 container" style="margin: 0 auto;">
            <center>
                <h3 style="margin: 5px; padding: 5px;">SOS - Form</h3>
            </center>
            <form class="needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="Name" class="form-label">Name</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" style="width: 100%;" id="floatingInput" placeholder="Enter name" name="name">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" style="width: 100%;" id="address" placeholder="1234 Main St" required="">
                    </div>

                    <div class="col-12">
                        <label for="username" class="form-label">Phone number</label>
                        <div class="input-group has-validation">
                            <input type="text" name="contact_no" class="form-control" style="width: 100%;" id="floatingInput" placeholder="+XXXXXXXXXXXX" maxlength="13" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="additionalinfo" class="form-label">Additional Information</label>
                        <input type="text" name="other" class="form-control" style="width: 100%;" id="additionalinfo" placeholder="" required="">
                    </div>
                </div>
                <br>
                <center><button id="getHelpButton" type="submit" class="btn btn-success">Get Help</button></center><br>
            </form>
            <center>
                <a href="./u_afterlogin.php"><button type="button" id="getHelpButton" class="btn btn-success">Go Back</button></a>
            </center>
        </div>
        <footer class="pt-3 text-body-secondary text-center text-small">
            <center>
                <p class="mb-1" style="color: white;">©️ SBP</p>
            </center>
        </footer>
    </div>
</body>

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

    // Prompt
    // document.getElementById('getHelpButton').addEventListener('click', function(event) {
    //     event.preventDefault(); // Prevent the default action of the button

    //     // Show success prompt
    //     alert('Form submitted successfully!');
    // });
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</html>