<?php
include './U_CheckLogin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Schemes</title>
    <link rel="icon" type="image/x-icon" href="./logo.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5;
            padding: 5;
        }

        .container {
            max-width: 900px;
            margin: 0px auto;
            padding: 10px;
        }

        .scheme-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .scheme-card {
            width: calc(100% - 10px);
            height: 300px;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            background-size: cover;
            background-position: center;
            transition: transform 0.3s;
        }

        .scheme-card:hover {
            transform: translateY(-5px);
        }

        .scheme-content {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            transition: opacity 0.3s;
        }

        .scheme-card:hover .scheme-content {
            opacity: 1;
        }

        h3 {
            margin-top: 2px;
        }

        .scheme-link {
            text-decoration: none;
            color: #fff;
        }

        .btn{
            background-color: #159a15;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Darkmode */
        .darkmode{
            background-color: #1A1B1F;
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
        <center>
            <h1>Financial Schemes</h1>
        </center>
        <div class="scheme-container">
            <a href="https://en.wikipedia.org/wiki/Ayushman_Bharat_Yojana" class="scheme-link">
                <div class="scheme-card" style="background-image: url('./images/fs1.png');">
                    <div class="scheme-content">
                        <h3>Ayushman Bharat Pradhan Mantri Jan Arogya Yojana (AB-PMJAY)</h3>
                        <p>This is a government-funded health insurance scheme that provides coverage of up to ₹5
                            lakhs per family per year for secondary and tertiary care hospitalization.
                            It targets low-income families identified through Socio-Economic Caste Census (SECC) data.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="scheme-container">
            <a href="https://www.bhartiaxa.com/group-plans/pradhan-mantri-jeevan-jyoti-bima-yojana" class="scheme-link">
                <div class="scheme-card" style="background-image: url('./images/fs2.png');">
                    <div class="scheme-content">
                        <h3>Arogya Sanjeevani Health Insurance Scheme</h3>
                        <p>This scheme launched in 2020 is an extension of Ayushman Bharat PM-JAY. It offers standardized health insurance plans for individuals and families who are not covered under AB-PMJAY but wish to purchase subsidized health insurance. Plans vary in coverage amount and cater to different income groups. </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="scheme-container">
            <a href="https://www.hdfcbank.com/personal/insure/social-security-schemes/pradhan-mantri-suraksha-bima-yojana" class="scheme-link col">
                <div class="scheme-card" style="background-image: url(./images/fs3.png);">
                    <div class="scheme-content">
                        <h3>Pradhan Mantri Suraksha Bima Yojana (PMSBY)</h3>
                        <p>This scheme offers accidental death and disability insurance cover to people between 18 and 70 years of age for a premium of Rs. 12 per year.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="scheme-container">
            <a href="https://vajiramias.com/current-affairs/pradhan-mantri-ujjwala-yojana-pmuy/5c86292e1d5def18d99ed571/" class="scheme-link col">
                <div class="scheme-card" style="background-image: url('./images/fs4.png');">
                    <div class="scheme-content">
                        <h3>Pradhan Mantri Ujjwala Yojana (PMUY)</h3>
                        <p>This scheme was launched in 2016 to provide LPG connections to Below Poverty 
                            Line (BPL) households. It aims to empower women and improve their health by reducing 
                            indoor air pollution caused by cooking with solid fuels.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="scheme-container">
            <a href="https://www.jeevandayee.gov.in/" class="scheme-link col">
                <div class="scheme-card" style="background-image: url('./images/fs5.png');">
                    <div class="scheme-content">
                        <h3>Rajiv Gandhi Jeevan Jyoti Yojana (RGGJY)</h3>
                        <p>This scheme provides life insurance coverage, including some medical expenses, for a small premium. It's beneficial for individuals who might not have access to other health insurance options.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="scheme-container">
            <a href="https://en.wikipedia.org/wiki/Ayushman_Bharat_Yojana" class="scheme-link col">
                <div class="scheme-card" style="background-image: url('./images/fs6.png');">
                    <div class="scheme-content">
                        <h3>Pradhan Mantri Garib Kalyan Yojana (PMGKY)</h3>
                        <p>This scheme offers accidental death and disability cover, which can be helpful for managing medical expenses arising from accidents. It caters to people below the poverty line.
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <center><a href="./U_AfterLogin.php"><button class="btn">Go Back</button></a></center>
        
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