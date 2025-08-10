<?php
include './M_CheckLogin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        header {
            background-color: white;
            padding: 20px;
            text-align: center;
           
        }

        main {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(3, minmax(300px, 1fr));
            grid-gap: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            cursor: pointer;
            display: flex;
            flex-direction: column;
        }

        .card-header {
            position: relative;
        }

        .card-header img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .intro-text {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .card-content {
            padding: 10px;
            background-color: #f9f9f9;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .card-content.expanded {
            max-height: 2000px; 
        }

        /* Darkmode */
        .darkmode .container {
            background-color: #1A1B1F;
            color: white;
        }

        .darkmode {
            background-color: #000104;
            color: white;
        }

        .darkmode header {
            color: white;
            background-color: #000104;
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
<button id="dark-mode-toggle" class="dark-mode-toggle">
            <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
                <path fill="currentColor" d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z" transform="translate(-8 -8)" />
            </svg>
        </button>
    <header>
        <h1>Articles:</h1>
    </header>
        <hr>
    <main>
        <div class="card">
            <div class="card-header">
                <img src="images/bd.jpeg" alt="Article 1 Image">
                <div class="intro-text" style="color:black;">
                    <h2>Heart Dieases</h2>
                    <p>Heart disease remains the leading cause of death globally.This article delves into the current state of heart disease, exploring its
                        various forms, potential cures on the horizon, and the ongoing battle for a healthier future.
                    </p>

                </div>
            </div>
            <div class="card-content" style="color:black;">
            <p>Current Status:
                        According to WHO, cardiovascular diseases (CVDs) cause approximately 17.9 million deaths
                        annually, representing 31% of all global deaths.
                        Recent advancements in medical imaging techniques, such as cardiac MRI and CT angiography, have
                        improved diagnostic accuracy.
                        <br>
                        <br>
                        Cure and Treatment:
                        While a definitive cure is lacking, treatment focuses on symptom management, disease
                        progression, and complication prevention.
                        Pharmacotherapy includes medications like statins, beta-blockers, and ACE inhibitors to control
                        blood pressure, cholesterol, and heart rhythm abnormalities.
                        Interventional procedures like angioplasty, stent placement, and coronary artery bypass surgery
                        restore blood flow to the heart.
                        Implantable devices such as pacemakers and defibrillators regulate abnormal heart rhythms and
                        prevent sudden cardiac arrest.
                        <br>
                        <br>
                        Types of Heart Disease:
                        <br>
                        Coronary Artery Disease (CAD): Characterized by atherosclerosis leading to narrowed coronary
                        arteries, causing chest pain or heart attacks.
                        <br>
                        Heart Failure: Occurs when the heart cannot pump enough blood, resulting in symptoms like
                        fatigue, shortness of breath, and fluid retention.
                        Arrhythmias: Irregular heart rhythms disrupt pumping function, increasing the risk of stroke or
                        cardiac arrest.
                        <br>
                        Valvular Heart Disease: Dysfunction of heart valves leads to symptoms like chest pain, fatigue,
                        and shortness of breath.
                        <br>
                        <br>
                        Preventive Measures:
                        Lifestyle modifications such as a heart-healthy diet, regular exercise, and smoking cessation
                        reduce risk factors.
                        Managing conditions like hypertension, diabetes, and hyperlipidemia through early detection and
                        intervention is crucial.
                        <br>
                        Coronary Artery Disease (CAD): Characterized by atherosclerosis leading to narrowed coronary
                        arteries, causing chest pain or heart attacks.
                        <br>
                        Heart Failure: Occurs when the heart cannot pump enough blood, resulting in symptoms like
                        fatigue, shortness of breath, and fluid retention.
                        Arrhythmias: Irregular heart rhythms disrupt pumping function, increasing the risk of stroke or
                        cardiac arrest.
                        <br>
                        Valvular Heart Disease: Dysfunction of heart valves leads to symptoms like chest pain, fatigue,
                        and shortness of breath.
                        <br>
                        <br>
                        Preventive Measures:
                        Lifestyle modifications such as a heart-healthy diet, regular exercise, and smoking cessation
                        reduce risk factors.
                        Managing conditions like hypertension, diabetes, and hyperlipidemia through early detection and
                        intervention is crucial.



            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <img src="images/Blood.png" alt="Article 2 Image">
                <div class="intro-text" style="color:black;">
                    <h2>Diabetes</h2>
                    <p>Diabetes is a chronic metabolic disorder characterized by high blood sugar levels.
                        It poses a significant public health concern globally due to its rising prevalence and
                        associated complications.</p>

                </div>
            </div>
            <div class="card-content" style="color:black;">
            <p>
                Current Status:
                The International Diabetes Federation (IDF) estimates that approximately 463 million adults aged
                20-79 years were living with diabetes in 2019, with projections indicating a steady increase.
                Diabetes is associated with numerous complications, including cardiovascular disease, kidney
                disease, neuropathy, and retinopathy.
                <br>
                <br>
                Cure and Treatment:
                While there is no cure for diabetes, treatment focuses on managing blood sugar levels to prevent
                complications and improve quality of life.
                Pharmacotherapy includes oral medications like metformin, sulfonylureas, and insulin injections
                to regulate blood glucose levels.
                Lifestyle modifications such as adopting a balanced diet, regular physical activity, weight
                management, and smoking cessation are essential components of diabetes management.
                Continuous glucose monitoring (CGM) devices and insulin pumps are technological advancements
                that aid in diabetes management, providing real-time data and insulin delivery.
                <p>
                Current Status:
                The International Diabetes Federation (IDF) estimates that approximately 463 million adults aged
                20-79 years were living with diabetes in 2019, with projections indicating a steady increase.
                Diabetes is associated with numerous complications, including cardiovascular disease, kidney
                disease, neuropathy, and retinopathy.
                <br>
                <br>
                Cure and Treatment:
                While there is no cure for diabetes, treatment focuses on managing blood sugar levels to prevent
                complications and improve quality of life.
                Pharmacotherapy includes oral medications like metformin, sulfonylureas, and insulin injections
                to regulate blood glucose levels.
                Lifestyle modifications such as adopting a balanced diet, regular physical activity, weight
                management, and smoking cessation are essential components of diabetes management.
                Continuous glucose monitoring (CGM) devices and insulin pumps are technological advancements
                that aid in diabetes management, providing real-time data and insulin delivery.
                <br>
                <br>
                Types of Diabetes:
                <br>
                Type 1 Diabetes: An autoimmune condition where the body's immune system attacks
                insulin-producing beta cells in the pancreas, requiring lifelong insulin therapy.
                <br>
                Type 2 Diabetes: Typically develops in adults and is characterized by insulin resistance, where
                cells fail to respond to insulin properly. It may be managed with lifestyle changes, oral
                medications, or insulin therapy.
                <br>
                Gestational Diabetes: Occurs during pregnancy and usually resolves after childbirth, but
                increases the risk of developing type 2 diabetes later in life.
                <br>
                <br>
                Preventive Measures:
                Adopting a healthy lifestyle, including a balanced diet rich in fruits, vegetables, whole
                grains, and lean proteins, is crucial in preventing type 2 diabetes.
                Regular physical activity helps improve insulin sensitivity and control blood sugar levels.
                Maintaining a healthy weight through portion control and calorie moderation reduces the risk of
                developing type 2 diabetes.
                Screening for prediabetes and early detection of diabetes through routine medical check-ups
                enable timely intervention and lifestyle modifications.
                <br>
                <br>
                Conclusion:
                In conclusion, diabetes remains a significant health challenge worldwide, with its prevalence on
                the rise. While there is no cure, effective management strategies, including medication,
                lifestyle modifications, and technological advancements, play a vital role in controlling blood
                sugar levels and preventing complications. By raising awareness, promoting healthy lifestyles,
                and investing in diabetes research and care, we can mitigate the burden of diabetes and improve
                the quality of life for individuals affected by this condition.
            </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <img src="images/heart.jpeg" alt="Article 3 Image">
                <div class="intro-text" style="color:black;">
                    <h2>Understanding Migraines</h2>
                    <p>Migraines are a neurological condition characterized by severe, recurring headaches often accompanied by other symptoms like nausea, vomiting, and sensitivity to light and sound. </p>
                </div>
            </div>
            <div class="card-content" style="color:black;">
                <p>Migraines are a neurological condition characterized by severe, recurring headaches often accompanied by other symptoms like nausea, vomiting, and sensitivity to light and sound. Migraine headaches are more than just bad headaches - they are a debilitating disorder that can significantly impact quality of life.
                    Causes
                    While the exact causes of migraines are not fully understood, they are believed to be the result of abnormal brain activity temporarily affecting nerve signals, chemicals and blood vessels in the brain. Potential migraine triggers include hormonal changes, stress, certain foods, changes in sleep or weather patterns, and environmental factors like strong smells.
                    Symptoms
                    Migraine symptoms can vary in type and intensity, but typically involve a severe, throbbing, pulsating headache on one side of the head. Other common symptoms are nausea, vomiting, sensitivity to light/sound/smell, dizziness, and visual disturbances like auras (flashing lights/blind spots). Some migraineurs experience a prodrome or warning phase before the migraine, with mood changes, food cravings or other subtle signs.
                    Types
                    There are different classifications of migraines based on symptoms and patterns. Migraines with aura involve visual or sensory disturbances preceding or accompanying the headache. Chronic migraines are defined as experiencing 15 or more migraine days per month. Status migrainosus refers to a debilitating migraine attack lasting over 72 hours.
                    Treatments
                    While there is no cure for migraines, treatments focus on prevention and relief during attacks. Lifestyle adjustments like stress management, regular sleep, staying hydrated and avoiding triggers can help reduce frequency. Over-the-counter pain relievers like ibuprofen or acetaminophen can provide relief for some migraines. Prescribed preventative medications aim to reduce migraine frequency. Other therapies include anti-nausea drugs, Botox injections, devices to apply pressure or electrical currents, massage and counseling.
                    Migraines can significantly diminish productivity and quality of life if not properly managed. Seeing a doctor to find an effective prevention and treatment plan is important for migraineurs. With the right therapy, many can experience fewer and less severe migraine attacks.</p>
            </div>
        </div>
        
    </main>

    <script>
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const cardHeader = card.querySelector('.card-header');
            const cardContent = card.querySelector('.card-content');

            cardHeader.addEventListener('click', () => {
                cardContent.classList.toggle('expanded');
            });
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
</body>
</html>