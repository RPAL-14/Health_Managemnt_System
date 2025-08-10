<?php
    include './U_CheckLogin.php';
    $uid = $_SESSION["userUID"];

    ob_start();
    require('./fpdf/fpdf.php');
    include './A_RetrieveXRAY.php';
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
            $this -> Cell(30, 15, 'X-RAY Report (Radiology)', 0, 1, 'C');
            
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

    // RETRIEVING XRAY REPORT INFORMATION
    $sql = "SELECT * FROM $dbname.invxray WHERE BUID = $uid ORDER BY DateOfTest DESC;";
    if ((mysqli_num_rows(mysqli_query($conn, $sql))) > 0) {
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $OUID = $result["OUID"];

        $SampleCollectionAddress = $result["HID"];
        $sqlForAddress = "SELECT * FROM $dbname.hospitals WHERE HID = $SampleCollectionAddress;";
        $resultaddress = mysqli_fetch_assoc(mysqli_query($conn, $sqlForAddress));
        $address = $resultaddress["Name"] .", ". $resultaddress["District"] .", ". $resultaddress["State"] .".";
        $contact = $resultaddress["Contact"];

        $DateOfTest = $result["DateOfTest"];
        $Modality = $result["Modality"];
        $Part = $result["Part"];
        $Technique = $result["Technique"];
        $Findings = $result["Findings"];
        $Impression = $result["Impression"];
        $Conclusion = $result["Conclusion"];
    } else {
        echo '<script>alert("No X-RAY record found!");</script>';
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

    $pdf -> Ln(2);
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(11, 10,'Note: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, 'The dates in this certificate follows YYYY/MM/DD format!', 0, 1);
    


    $pdf -> Ln(10);
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(190, 10, 'X-RAY Report', 1, 1);
    
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Diagnoser By (UID): ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $OUID, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Diagnosed At: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $address, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Institution Contact No: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $contact, 0, 1);

    $pdf -> Ln(10);
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Date of Test: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $DateOfTest, 0, 1);
    
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Modality: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $Modality, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Part: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $Part, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Technique: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $Technique, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Findings: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $Findings, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'Impression: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, $Impression, 0, 1);

    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 0,'Conclusion: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 0, $Conclusion, 0, 1);

    $pdf -> Ln(10);
    $pdf -> SetFont('Times', 'B', 12);
    $pdf -> Cell(55, 10,'X-RAY: ', 0, 0);
    $pdf -> SetFont('Times', '', 12);
    $pdf -> Cell(35, 10, 'Following is the X-RAY image of '.$Part.'.', 0, 1);
    $pdf -> Image($pathtoXRAY);

    if (file_exists($pathtoXRAY)) {
        unlink($pathtoXRAY);
    }
    
    $pdf->Output('D', 'XRAY_Report.pdf');
    ob_end_flush();
?>