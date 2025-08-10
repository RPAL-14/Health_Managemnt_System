<?php
    include './U_CheckLogin.php';
    $uid = $_SESSION["userUID"];

    ob_start();
    require('./fpdf/fpdf.php');
    include './E_dbConnect.php';
    include './E_validation.php';

    class PDF extends FPDF {
        function Header() {
            $this -> Image('logo.png', 10, 6, 30);
            $this -> SetFont('Times', 'B', 35);
            $this -> Cell(80);
            $this -> Cell(30, 5, 'Swasth Bharat Pranali', 0, 1, 'C');
            $this -> Cell(72);
            $this -> SetFont('Times', 'B', 25);
            $this -> Cell(30, 15, 'LFT Report (Biochemistry)', 0, 1, 'C');
            
            $this -> SetFont('Times', 'B', 12);
            $this -> Cell(35);
            $this -> Cell(35, 0, 'Report Generated: ', 0, 0);
            $this -> SetFont('Times', '', 12);
            date_default_timezone_set("Asia/Calcutta");
            $this -> Cell(35, 0, date("Y-m-d"), 0, 1);
            $this -> Ln(10);
        }

        function Footer() {
            $this -> SetY(-15);
            $this -> SetFont('Arial', 'I', 8);
            $this -> Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
        }
    }

    // RETRIEVING GENERAL INFORMATION
    $sql = "SELECT * FROM $dbname.clientinfo WHERE UID = $uid;";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $name = $result["Name"];
    $sex = $result["Sex"];
    $dob = $result["DOB"];
    $height = $result["Height"];
    $weight = $result["Weight"];
    $bmi = $result["BMI"];
    $bloodgroup = $result["BloodGroup"];
    $allergies = $result["AllergiesReactions"];

    // RETRIEVING PRESCRIPTION INFORMATION
    $sql = "SELECT * FROM $dbname.prescription WHERE BUID = $uid ORDER BY CurrentDate DESC;";
    if ((mysqli_num_rows(mysqli_query($conn, $sql))) > 0) {
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $followup = $result["FollowUp"];
        $remarks = $result["Remarks"];
        $medicines = $result["Medicines"];
        $date = $result["CurrentDate"];
    }

    // RETRIEVING LFT REPORT INFORMATION
    $sql = "SELECT * FROM $dbname.invlft WHERE BUID = $uid ORDER BY 'SampleCollectionTime' DESC;";
    if ((mysqli_num_rows(mysqli_query($conn, $sql))) > 0) {
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $SampleOUID = $result["SampleOUID"];
        $ReportOUID = $result["ReportOUID"];
        $SampleCollectionAddress = $result["SampleCollectionAddress"];

        $sqlForAddress = "SELECT * FROM $dbname.hospitals WHERE HID = $SampleCollectionAddress;";
        $resultaddress = mysqli_fetch_assoc(mysqli_query($conn, $sqlForAddress));
        $contact = $resultaddress["Contact"];
        $address = $resultaddress["Name"] .", ". $resultaddress["District"] .", ". $resultaddress["State"] .".";
        $SampleCollectionTime = $result["SampleCollectionTime"];
        $ReportGenerated = $result["ReportGenerated"];
        $ALT = $result["ALT"];
        $AST = $result["AST"];
        $GGPT = $result["GGPT"];
        $ALP = $result["ALP"];
        $totalBilirubin = $result["totalBilirubin"];
        $directBilirubin = $result["directBilirubin"];
        $indirectBilirubin = $result["indirectBilirubin"];
        $Globulin = $result["Globulin"];
        $Albumin = $result["Albumin"];
        $totalProtein = $result["totalProtein"];
        $AST_ALT = $result["AST_ALT"];
        $agRatio = $result["agRatio"];
    } else {
        echo '<script>alert("No prescription record found!");</script>';
        ?>
        <script>
            window.location.href = "http://localhost/hms/u_afterlogin.php";
        </script>
        <?php
        mysqli_close($conn);
        exit();
    }

    mysqli_close($conn);

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf -> AliasNbPages();
    $pdf -> AddPage();
    $pdf -> SetAutoPageBreak(true, 20);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(190, 10, 'Beneficiary Information', 1, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Beneficiary UID: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $uid, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Beneficiary Name: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $name, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Sex: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $sex, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Date of birth: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $dob, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Height: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $height, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Weight: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $weight, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'BMI: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $bmi, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Blood Group: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $bloodgroup, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Allergies and Reactions: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $allergies, 0, 1);



    $pdf -> Ln(10);
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(190, 10, "Beneficiary Medical Status (As on " . ($date ?? '-') . ")", 1, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Follow-Up Visit: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $followup ?? '-', 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Medicines prescribed: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $medicines ?? '-', 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Remarks from Doctor: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $remarks ?? '-', 0, 1);

    $pdf -> Ln(2);
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(11, 0,'Note: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, 'The dates in this certificate follows YYYY/MM/DD format!', 0, 1);
    


    $pdf -> Ln(10);
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(190, 10, 'Liver Function Test Report', 1, 1);
    
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Sample Collector UID: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $SampleOUID, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Report Maker UID: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $ReportOUID, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Sample Collected At: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $address, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Sample Collection Time: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $SampleCollectionTime, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Report Generation Time: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $ReportGenerated, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Hospital Contact: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $contact, 0, 1);

    $pdf -> Ln(10);
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Parameters', 0, 0);
    $pdf -> Cell(35, 10,'Value', 0, 0);
    $pdf -> Cell(35, 10,'Reference Value', 0, 0);
    $pdf -> Cell(35, 10,'Unit', 0, 0);
    $pdf -> Cell(35, 10,'Status', 0, 1);
    $pdf -> Ln(3);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'ALT (SGPT): ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $ALT, 0, 0);
    $pdf -> Cell(35, 0, '15.00 - 40.00', 0, 0);
    $pdf -> Cell(35, 0, 'U/L', 0, 0);
    if ($ALT > 40) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'High', 0, 1);
    } elseif ($ALT < 15) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'Low', 0, 1);
    } else {
        $pdf -> Cell(35, 0, 'Within Limit', 0, 1);
    }

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'AST (SGOT): ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $AST, 0, 0);
    $pdf -> Cell(35, 10, '10.00 - 49.00', 0, 0);
    $pdf -> Cell(35, 10, 'U/L', 0, 0);
    if ($AST > 49) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'High', 0, 1);
    } elseif ($AST < 10) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'Low', 0, 1);
    } else {
        $pdf -> Cell(35, 10, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'AST : ALT Ratio: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $AST_ALT, 0, 0);
    $pdf -> Cell(35, 0, '< 1.00', 0, 0);
    $pdf -> Cell(35, 10, '', 0, 0);
    if ($AST_ALT > 1) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'High', 0, 1);
    } else {
        $pdf -> Cell(35, 0, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'GGPT: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $GGPT, 0, 0);
    $pdf -> Cell(35, 10, '0.00 - 73.00', 0, 0);
    $pdf -> Cell(35, 10, 'U/L', 0, 0);
    if ($GGPT > 73) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'High', 0, 1);
    } else {
        $pdf -> Cell(35, 10, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'ALP (Alkaline Phosphatase): ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $ALP, 0, 0);
    $pdf -> Cell(35, 0, '30.00 - 120.00', 0, 0);
    $pdf -> Cell(35, 0, 'U/L', 0, 0);
    if ($ALP > 120) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'High', 0, 1);
    } elseif ($ALP < 30) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'Low', 0, 1);
    } else {
        $pdf -> Cell(35, 0, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Total bilirubin: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $totalBilirubin, 0, 0);
    $pdf -> Cell(35, 10, '0.30 - 1.20', 0, 0);
    $pdf -> Cell(35, 10, 'mg/dL', 0, 0);
    if ($totalBilirubin > 1.20) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'High', 0, 1);
    } elseif ($totalBilirubin < 0.30) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'Low', 0, 1);
    } else {
        $pdf -> Cell(35, 10, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Direct bilirubin: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $directBilirubin, 0, 0);
    $pdf -> Cell(35, 0, '< 0.3', 0, 0);
    $pdf -> Cell(35, 0, 'mg/dL', 0, 0);
    if ($directBilirubin > 0.3) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'High', 0, 1);
    } else {
        $pdf -> Cell(35, 0, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Indirect bilirubin: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $indirectBilirubin, 0, 0);
    $pdf -> Cell(35, 10, '< 1.10', 0, 0);
    $pdf -> Cell(35, 10, 'mg/dL', 0, 0);
    if ($indirectBilirubin > 1.10) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'High', 0, 1);
    } else {
        $pdf -> Cell(35, 10, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Total Protein: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $totalProtein, 0, 0);
    $pdf -> Cell(35, 0, '5.70 - 8.20', 0, 0);
    $pdf -> Cell(35, 0, 'g/dL', 0, 0);
    if ($totalProtein > 8.20) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'High', 0, 1);
    } elseif ($totalProtein < 5.70) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'Low', 0, 1);
    } else {
        $pdf -> Cell(35, 0, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Albumin: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $Albumin, 0, 0);
    $pdf -> Cell(35, 10, '3.20 - 4.80', 0, 0);
    $pdf -> Cell(35, 10, 'g/dL', 0, 0);
    if ($Albumin > 4.80) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'High', 0, 1);
    } elseif ($Albumin < 3.20) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'Low', 0, 1);
    } else {
        $pdf -> Cell(35, 10, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Globulin: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $Globulin, 0, 0);
    $pdf -> Cell(35, 0, '2.00 - 3.50', 0, 0);
    $pdf -> Cell(35, 0, 'g/dL', 0, 0);
    if ($Globulin > 3.50) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'High', 0, 1);
    } elseif ($Globulin < 2.00) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 0, 'Low', 0, 1);
    } else {
        $pdf -> Cell(35, 0, 'Within Limit', 0, 1);
    }
   
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'A : G Ratio: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $agRatio, 0, 0);
    $pdf -> Cell(35, 10, '0.90 - 2.00', 0, 0);
    $pdf -> Cell(35, 10, '', 0, 0);
    if ($agRatio > 2.00) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'High', 0, 1);
    } elseif ($agRatio < 0.90) {
        $pdf -> SetFont('Times', 'B', 12);
        $pdf -> Cell(35, 10, 'Low', 0, 1);
    } else {
        $pdf -> Cell(35, 10, 'Within Limit', 0, 1);
    }

    $pdf->Output('D', 'LFT_Report.pdf');
    ob_end_flush();
?>