<?php
    include './E_dbConnect.php';
    $uid = $_SESSION['tbuid'];
    $stmt = $conn->prepare("SELECT * FROM $dbname.invxray WHERE BUID = $uid ORDER BY DateOfTest DESC;");
    $stmt -> execute();
    $result = $stmt->get_result();
    $image = $result->fetch_assoc();

    file_put_contents('./sample2.png', base64_decode($image['Image']));
    $pathtoXRAY = './sample2.png';
    $stmt->close();
?>