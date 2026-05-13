<?php
require __DIR__ . '/../vendor/autoload.php';
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile(__DIR__ . '/../storage/app/imports/Region 5 -ARBOs Products.xlsx');
$s = $reader->load(__DIR__ . '/../storage/app/imports/Region 5 -ARBOs Products.xlsx');
$rows = $s->getActiveSheet()->toArray(null, true, true, true);
echo "Total rows: " . count($rows) . "\n";
$i = 0;
foreach ($rows as $r) {
    print_r($r);
    if (++$i > 10) break;
}
