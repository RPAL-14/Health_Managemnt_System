<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Swasth Bharat Pranali</title>
	<link rel="stylesheet" href="translate.css">
	<link rel="icon" type="image/x-icon" href="./logo.ico">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+zX25LcXT4Dg2n9azvm6bF8a5n2p0+I5tJgJUpJ" crossorigin="anonymous">

	<style>
		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}

		/* Navbar */
		nav {
			display: flex;
			justify-content: center;
			background-color: #444;
			padding: 0.5em;
		}

		nav a {
			color: #fff;
			text-decoration: none;
			padding: 0.5em 1em;
			margin: 0;
			border-radius: 4px;
			transition: background-color 0.3s;
		}

		/* STYLING */
		.container {
			display: flex;
			height: 100vh;
			background-color: #f4f4f4;
			color: #a2a2a2;
			font-family: "Nunito Sans", Arial, Helvetica, sans-serif;
			height: 100%;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			text-align: center;
			margin: 0px;
			padding: 0px;
		}

		/* Styling for FAQS */
		h1 {
			text-align: center;
		}

		.faq-item {
			margin-bottom: 20px;
			text-align: center;
		}

		.question {
			font-weight: bold;
			cursor: pointer;
			padding: 10px;
			border-radius: 5px;
		}

		.answer {
			display: none;
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 5px;
		}

		.answer.active {
			display: block;
		}

		.small-screen {
			display: none;
			background-color: #f4f4f4;
			height: 100vh;
			color: #a2a2a2;
			font-family: "Nunito Sans", Arial, Helvetica, sans-serif;
		}

		.small-screen-content {
			width: 70%;
			margin: auto;
		}

		@media only screen and (max-width: 600px) {
			.container {
				display: none;
			}

			.small-screen {
				display: flex;
			}

			.tabcontent {
				display: block;
			}
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

		.darkmode h2 {
			color: white;
		}

		.darkmode .example-article {
			background-color: #2B2B2B;
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

		/* Articles */
		.article-section {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-top: 50px;
			padding: 20px;
			background-color: rgba(240, 240, 240, 0.8);
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.animation-container {
			flex: 1;
		}

		.example-article {
			flex: 1;
			margin-left: 20px;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
			background-color: white;
			color: black;
		}

		.example-article h3 {
			margin-top: 0;
		}

		.example-article p {
			margin-bottom: 0;
		}

		.article-link {
			color: blue;
			text-decoration: underline;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top mt-0" style="margin-top: 0; padding: 0;">
		<div class="container-fluid" style="background-color: #2D9596; ">
			<svg xmlns="http://www.w3.org/2000/svg" width="70" height="40" fill="currentColor" class="bi bi-heart-pulse"
				viewBox="0 0 16 16" style="margin: 10px; color:white">
				<path
					d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857q.09.083.176.171a3 3 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01zM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5" />
				<path
					d="M10.464 3.314a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162z" />
			</svg>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="./H_AboutUs.php"
							style="color: white;">About us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./H_ContactUs.php" style="color: white;">Contact</a>
					</li>
					
					<!-- languagessssssssss -->
					<div id="google_translate_element" style="margin-top: 10px;"></div>
					<script
						src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
					<script src="translate.js"></script>
				</ul>

				<div>
					<a href="./H_SOS.php"><button type="button" class="btn btn-danger">SOS</button></a>
				</div>

				<div class="nav-item dropdown" style="margin-right: 30px;">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
						aria-expanded="false" style="color: white;">
						Login
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="./U_Login.php">User Login</a>
						<a class="dropdown-item" href="./M_Login.php">Management Login</a>
						<a class="dropdown-item" href="./G_Login.php">Government Login</a>
					</div>
					</ul>
				</div>

				<div class="nav-item" style="margin-right: 20px;">
					<button id="dark-mode-toggle" class="dark-mode-toggle">
						<svg style="top: 50%; left: 50%; transform: translate(-50%, -75%); position: relative;"
							width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
							<path fill="currentColor"
								d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z"
								transform="translate(-8 -8)" />
						</svg>
					</button>
				</div>
			</div>
		</div>
	</nav>

	<!-- Carousel -->
	<div style="max-width: 100%;">
		<div id="carouselExampleCaptions" class="carousel slide" style="padding-top: 60px;">
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
					aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
					aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
					aria-label="Slide 3"></button>
			</div>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="./images/Doctor1.png" class="d-block w-100">
					<div class="carousel-caption d-none d-md-block text-start"
						style="margin-left: 0;margin-bottom: 60px;">
						<h1 style="text-align: start;">Welcome to<br>Swasth Bharat Pranali</h1><br>
						<p>Our dedicated team of healthcare professionals is committed to guiding you on your health
							journey, empowering you to make informed decisions and fostering a sense of well-being
							at every step.Health management involves the coordination, planning, execution, and
							evaluation of
							strategies and
							initiatives aimed at improving and maintaining individual and population health. It
							encompasses a wide
							range of activities and practices that contribute to promoting wellness, preventing
							diseases, and
							addressing health challenges
							effectively.</p>
					</div>
				</div>
				<div class="carousel-item">
					<div class="image-container">
						<img src="./images/Patient1.png" class="d-block w-100">
					</div>
					<div class="carousel-caption d-none d-md-block text-start" style="margin-bottom: 150px;">
						<h1 style="text-align: center;">Our Objective:</h1><br>
						<p>
							Our primary objective is to streamline the process of accessing medical data for citizens
							across India.
							By leveraging state-of-the-art technology, we aim to eliminate the barriers that often
							hinder
							individuals from obtaining their health records promptly. The Swasth Bharat Pranali is
							specifically
							designed to cater to the government sector, providing a robust platform that allows
							authorized personnel
							to access medical data efficiently and securely.
						</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="./images/Medicine1.png" class="d-block w-100 img-fluid" alt="Doctor">
					<div class="carousel-caption d-none d-md-block text-start" style="margin-bottom: 50px;">
						<h1>Our Commitment:</h1>
						<p>Swasth Bharat Pranali is committed to contributing to the overall improvement of healthcare
							in India. By
							empowering citizens with easy access to their medical data, we aim to foster a healthier and
							more informed
							society. Our partnership with the government reflects our dedication to aligning
							technological
							advancements with
							the public interest, creating a sustainable healthcare ecosystem for generations to come.
							Join us on this
							transformative journey towards a healthier and more connected India. Swasth Bharat Pranali -
							Your Health,
							Your
							Data, Your Control.</p>
						<center><button type="button" class="btn btn-success">
								<a href="./H_AboutUs.php" style="color: white; text-decoration: none;">Explore more</a>
							</button></center>
					</div>
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
				data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
				data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>

	<div class="article-section"
		style="background: url(images/Blood\ Donation.jpeg); margin-bottom: 50px;border-radius: 0;">
		<div class="animation-container" style="color: white;">
			<h2>Read Our Articles to Learn More</h2>
			<!-- Animation goes here -->
		</div>
		<a href="./H_Article.php" class="article-link" style="text-decoration: none; color: black;">
			<div class="example-article">
				<h2>Heart Disease</h2>
				<p>Heart disease is a common health problem affecting millions of people worldwide. It includes various
					conditions such as coronary artery disease, heart attack, and congestive heart failure.</p>
				<p>Current Status: Heart disease is a leading cause of death globally.</p>
		</a>
	</div>
	</div>


	<!-- FAQs -->
	<hr>
	<div>
		<h1>Frequently Asked Questions (FAQs)</h1>
		<hr>

		<div class="faq-item">
			<div class="question" onclick="toggleAnswer(this)">1. What services does Swasth Bharat Pranali provide?
			</div>
			<div class="answer">
				Swasth Bharat Pranali provides a range of healthcare services, including preventive care, health
				education,
				vaccination programs, and access to affiliated healthcare facilities.
			</div>
		</div>

		<div class="faq-item">
			<div class="question" onclick="toggleAnswer(this)">2. How can I access healthcare services through Swasth
				Bharat Pranali?</div>
			<div class="answer">
				To access healthcare services, you can visit our official website or contact our helpline for
				information on
				registered healthcare providers and facilities in your area.
			</div>
		</div>
		<div class="faq-item">
			<div class="question" onclick="toggleAnswer(this)">3. What are the eligibility criteria for availing health
				services?</div>
			<div class="answer">
				Eligibility criteria may vary for different services. Generally, individuals may qualify based on
				factors
				such as income, residence, or specific health conditions. Check our official guidelines or contact us
				for
				detailed information.
			</div>
		</div>
		<div class="faq-item">
			<div class="question" onclick="toggleAnswer(this)">4. How can I find a healthcare facility near me that is
				affiliated with Swasth Bharat Pranali?</div>
			<div class="answer">
				Visit our website and use the hospital locator tool to find healthcare providers and facilities in your
				vicinity that are affiliated with Swasth Bharat Pranali.
			</div>
		</div>
		<div class="faq-item">
			<div class="question" onclick="toggleAnswer(this)">5. What preventive measures can I take to maintain good
				health?</div>
			<div class="answer">
				Practice regular handwashing, maintain a balanced diet, engage in regular physical activity, stay
				up-to-date
				on vaccinations, and follow health guidelines provided by Seraphic Health Directorate.
			</div>
		</div>

		<!-- Add more FAQ items as needed -->

	</div>
	</div>
	</div>

	<!-- --------------------------------footer------------ -->

	<div style="background-color: grey; color:white;">
		<footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 pt-3 border-top">
		<div class="col" style="margin-top: 40px;">
                <center><svg xmlns="http://www.w3.org/2000/svg" width="70" height="40" fill="currentColor" class="bi-heart-pulse"
          viewBox="0 0 16 16" style="color:white; margin-bottom:0px;">
          <path
            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857q.09.083.176.171a3 3 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01zM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5" />
          <path
            d="M10.464 3.314a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162z" />
        </svg>
                <h2>Swasth Bharat Pranali</h></center>
            </div>

			<div class="col mb-3">

			</div>

			<div class="col mb-3" style="margin-left: 100px;">
				<ul class="nav flex-column" style="margin-left: 10px; margin-top: 50px;">
					<li class="nav-item mb-2"><a href="./H_SOS.php"
							class="nav-link p-0 text-body-secondary">SOS</a></li>
					<li class="nav-item mb-2"><a href="./H_AboutUs.php"
							class="nav-link p-0 text-body-secondary">About Us</a></li>
					<li class="nav-item mb-2"><a href="./H_ContactUs.php"
							class="nav-link p-0 text-body-secondary">Contact Us</a></li>
				</ul>
			</div>

			<div class="col" style="margin-left: 100px;">
            <h5>Contact Us</h5>
            <p class="text-body-secondary">For general inquiries, you can also reach us at:</p>
            <p class="text-body-secondary">Email: <a href="mailto:info@SwasthBharatPranali.gov.in" class="text-body-secondary">info@SwasthBharatPranali.gov.in</a></p>
            <p class="text-body-secondary">Phone: +91 123 456 7890</p>
			</div>

			<div class="col mb-3">

			</div>
		</footer>
	</div>

	<!---------------------------------->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
	<script>
		//FAQs answer toggle
		function toggleAnswer(element) {
			const answer = element.nextElementSibling;
			answer.classList.toggle('active');
		}

		// JavaScript to trigger the carousel's next slide every 5 seconds
		document.addEventListener("DOMContentLoaded", function () {
			// Select the carousel element
			var carouselElement = document.querySelector("#carouselExampleCaptions");
			// Create a new Bootstrap carousel instance
			var carousel = new bootstrap.Carousel(carouselElement);
			// Function to move to the next slide
			function moveToNextSlide() {
				carousel.next();
			}
			// Set an interval to move to the next slide every 5 seconds
			setInterval(moveToNextSlide, 5000); // Adjust the interval (in milliseconds) as needed
		});

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


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
		crossorigin="anonymous"></script>
</body>

</html>