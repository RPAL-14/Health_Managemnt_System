<?php
include './U_CheckLogin.php';
$uid = $_SESSION["userUID"];

ob_start();
require('./fpdf/fpdf.php');
include './E_dbConnect.php';
include './E_validation.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('logo.png', 10, 6, 30);
        $this->SetFont('Times', 'B', 35);
        $this->Cell(80);
        $this->Cell(30, 5, 'Swasth Bharat Pranali', 0, 1, 'C');
        $this->Cell(71);
        $this->Cell(30, 15, 'Medical Certificate', 0, 1, 'C');

        $this->SetFont('Times', 'B', 12);
        $this->Cell(35);
        $this->Cell(35, 0, 'Report Generated: ', 0, 0);
        $this->SetFont('Times', '', 12);
        date_default_timezone_set("Asia/Calcutta");
        $this->Cell(40, 0, date("Y-m-d"), 0, 1);
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function AddTable($header, $data, $flag)
    {
        if ($flag == 1) {
            $this->Ln(10);
            foreach ($header as $col) {
                $this->Cell(63.4, 10, $col, 1, 0, 'C');
            }
            $this->Ln();

            $this->SetFont('Times', '', 8);
            foreach ($data as $row) {
                foreach ($row as $col) {
                    $this->Cell(63.4, 10, $col, 1, 0, 'C');
                }
                $this->Ln();
            }

        } else {
            $this->Ln(10);
            foreach ($header as $col) {
                $this->Cell(19, 10, $col, 1, 0, 'C');
            }
            $this->Ln();

            $this->SetFont('Times', '', 8);
            foreach ($data as $row) {
                foreach ($row as $col) {
                    $this->Cell(19, 10, $col, 1, 0, 'C');
                }
                $this->Ln();
            }
        }
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
} else {
    $date = "-";
}

// RETRIEVING MEDICAL HISTORY INFORMATION
$sql = "SELECT * FROM $dbname.medical WHERE BUID = $uid ORDER BY ReportGenerated DESC;";
if ((mysqli_num_rows(mysqli_query($conn, $sql))) > 0) {
    $theader = array('S. No.', 'Disease', 'Status', 'Stage', 'Medicines', 'Family Link', 'Findings', 'Diagnosed', 'Treated', 'Other Info');
    $tindex = 1;
    $tresult = mysqli_query($conn, $sql);
    $tdata = array();
    if ($tresult->num_rows > 0) {
        while ($trow = $tresult->fetch_assoc()) {
            $tdata[] = array($tindex, $trow['Disease'], $trow['Status'], $trow['Stage'], $trow['Medicines'], $trow['Family'], $trow['Findings'], $trow['Diagnosed'] ?? "-", $trow['Treated'] ?? "-", $trow['Other'] ?? "-");
            $tindex++;
        }
    }
}

// RETRIEVING VACCINATION HISTORY INFORMATION
$sql = "SELECT Vaccine, Dose FROM $dbname.vaccines AS V WHERE BUID = $uid AND Dose = (SELECT MAX(Dose) FROM $dbname.vaccines WHERE Vaccine = V.Vaccine);";
if ((mysqli_num_rows(mysqli_query($conn, $sql))) > 0) {
    $header = array('Serial Number', 'Vaccinated For', 'Doses Given');
    $index = 1;
    $result = mysqli_query($conn, $sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array($index, $row['Vaccine'], $row['Dose']);
            $index++;
        }
    }
}

mysqli_close($conn);

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(190, 10, 'Beneficiary Information', 1, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 10, 'Beneficiary UID: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 10, $uid, 0, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 10, 'Beneficiary Name: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 10, $name, 0, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 0, 'Sex: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 0, $sex, 0, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 10, 'Date of birth: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 10, $dob, 0, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 0, 'Height: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 0, $height, 0, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 10, 'Weight: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 10, $weight, 0, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 0, 'BMI: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 0, $bmi, 0, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 10, 'Blood Group: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 10, $bloodgroup, 0, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 0, 'Allergies and Reactions: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 0, $allergies, 0, 1);



$pdf->Ln(20);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(190, 10, 'Beneficiary Medical Status (As on ' . $date . ')', 1, 1);

if (!empty($followup) && !empty($medicines) && !empty($remarks)) {
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(50, 10, 'Follow-Up Visit: ', 0, 0);
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(40, 10, $followup, 0, 1);

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(50, 0, 'Medicines prescribed: ', 0, 0);
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(40, 0, $medicines, 0, 1);

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(50, 10, 'Remarks from Doctor: ', 0, 0);
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(40, 10, $remarks, 0, 1);
}

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(11, 0, 'Note: ', 0, 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 0, 'The dates in this certificate follows YYYY/MM/DD format!', 0, 1);



$pdf->Ln(20);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(190, 10, 'Beneficiary Vaccination History', 1, 1);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 10, 'Following are the vaccines provided to the beneficiary along with number of doses in tablur form.', 0, 0);
$pdf->SetFont('Times', 'B', 8);

if (!empty($header) && !empty($data)) {
    $pdf->AddTable($header, $data, 1);
}

$pdf->Ln(20);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(190, 10, 'Beneficiary Medical History', 1, 1);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(40, 10, 'Following are the details of medical history of the patient in tablur form.', 0, 0);
$pdf->SetFont('Times', 'B', 8);

if (!empty($theader) && !empty($tdata)) {
    $pdf->AddTable($theader, $tdata, 0);
}

$pdf->Output('D', 'Medical_Certificate.pdf');
ob_end_flush();
