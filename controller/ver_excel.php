<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_GET['file'])) {
    $filePath = "../uploads/" . $_GET['file'];

    if (file_exists($filePath)) {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();

        echo '<table border="1" cellspacing="0" cellpadding="5">';
        foreach ($sheet->getRowIterator() as $row) {
            echo '<tr>';
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                echo '<td>' . $cell->getValue() . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "No se especificó un archivo.";
}
?>
