<?php
include './U_CheckLogin.php';
include './E_dbConnect.php';
include './E_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['mobile']) && isset($_POST['email']) && isset($_POST['message'])) {

        $buid = $_SESSION["userUID"];
        $name = test_input($_POST['name']);
        $mobile = test_input($_POST['mobile']);
        $message = test_input($_POST['message']);
        $email = test_input($_POST['email']);

        $sql = "INSERT INTO $dbname.contactus (BUID, Mobile, Name, Email, Message) VALUES ($buid, '$mobile', '$name', '$email', '$message');";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Your details are submitted. We will contact you soon.');</script>";
        } else {
            echo '<script>alert("Your message was not delivered! Error: '.mysqli_error($conn).'.");</script>';
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
    <title>Contact Us - Swasth Bharat Pranali</title>
    <link rel="icon" type="image/x-icon" href="./logo.ico">
    <style>
        /* Darkmode */
        .darkmode .container {
            background-color: #1A1B1F;
            color: white;
        }

        .darkmode {
            background-color: #000104;
            color: white;
        }

        .darkmode h1 {
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

        body {
            font-family: Arial, sans-serif;
            background-image:url(./images/Contact.png);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input,
        textarea {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            padding-left: 20px;
            padding-right: 20px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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

        <h1>Contact Us</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">

            <label for="">Phone Number:</label>
            <input type="text" id="number" placeholder="+XXXXXXXXXXXX" name="mobile" required="" maxlength="13" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="XXXXXXXX@XXXX.XXX" required="" maxlength="320" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <center>
                <input type="submit" value="Submit">
            </center>

        </form>
        <center>
        <a href="./U_afterlogin.php"><input type="submit" value="Go Back"></a>
        </center>
        <p>For general inquiries, you can also reach us at:</p>
        <p>Email: info@SwasthBharatPranali.gov.in</p>
        <p>Phone: +91 123 456 7890</p>
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