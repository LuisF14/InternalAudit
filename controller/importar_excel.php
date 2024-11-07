<?php
require '../vendor/autoload.php';
$idplan = $_REQUEST['cod'];

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excelFile'])) {
    $targetDir = "../uploads/";
    $fileName = basename($_FILES["excelFile"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["excelFile"]["tmp_name"], $targetFilePath)) {
        header("Location: ../auditor/elemento.php?cod=$idplan&file=" . urlencode($fileName));
        exit;
    } else {
        echo "Error al subir el archivo.";
    }
}
?>
