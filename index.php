<?php

$filePath = "./test.csv";

$file = fopen($filePath, "r");

$fileSize = filesize($filePath);

if($file) {

    $row = 0;

    while (($data = fgetcsv($file))) {
        $num = count($data);
        echo "<p> $num champs à la ligne $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }

    fclose($file);
}
else {
    echo("Error opening file");
}
