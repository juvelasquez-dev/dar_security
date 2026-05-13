<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Product;

$filePath = __DIR__ . '/storage/app/imports/Region 5 -ARBOs Products.xlsx';

if (!file_exists($filePath)) {
    echo "File not found: {$filePath}\n";
    exit(1);
}

try {
    $reader = IOFactory::createReaderForFile($filePath);
    $spreadsheet = $reader->load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray(null, true, true, true);

    // Header row
    $first = array_shift($rows);
    // Find relevant columns by header name
    $cols = array_change_key_case($first, CASE_UPPER);
    $colMap = [];
    foreach ($cols as $col => $val) {
        $v = trim($val);
        if (stripos($v, 'PRODUCTS') !== false) $colMap['products'] = $col;
        if (stripos($v, 'SPECIFIC') !== false || stripos($v, 'SPECIFIC PRODUCTS') !== false) $colMap['specific'] = $col;
        if (stripos($v, 'NAME OF ARBO') !== false || stripos($v, 'NAME OF ARBO') !== false) $colMap['arbo'] = $col;
        if (stripos($v, 'PROVINCE') !== false) $colMap['province'] = $col;
        if (stripos($v, 'MUNICIPALITY') !== false) $colMap['municipality'] = $col;
    }

    $count = 0;
    foreach ($rows as $r) {
        $arbo = isset($colMap['arbo']) ? trim($r[$colMap['arbo']]) : null;
        $province = isset($colMap['province']) ? trim($r[$colMap['province']]) : null;
        $municipality = isset($colMap['municipality']) ? trim($r[$colMap['municipality']]) : null;

        $names = [];
        if (isset($colMap['products'])) {
            $p = trim($r[$colMap['products']]);
            if ($p !== '') {
                foreach (explode(',', $p) as $n) {
                    $n = trim($n);
                    if ($n !== '') $names[] = $n;
                }
            }
        }
        if (isset($colMap['specific'])) {
            $p = trim($r[$colMap['specific']]);
            if ($p !== '') {
                foreach (explode(',', $p) as $n) {
                    $n = trim($n);
                    if ($n !== '') $names[] = $n;
                }
            }
        }

        foreach (array_unique($names) as $prodName) {
            if ($prodName === '') continue;
            $meta = [
                'province' => $province ?: null,
                'municipality' => $municipality ?: null,
                'arbo' => $arbo ?: null,
                'products_raw' => isset($colMap['products']) ? trim($r[$colMap['products']]) : null,
                'specific_products' => isset($colMap['specific']) ? trim($r[$colMap['specific']]) : null,
                'services' => isset($colMap['services']) ? trim($r[$colMap['services']]) : null,
                'area_of_production' => isset($colMap['area']) ? trim($r[$colMap['area']]) : null,
                'marketing_arrangement' => isset($colMap['marketing']) ? trim($r[$colMap['marketing']]) : null,
                'contact_person' => isset($colMap['contact_person']) ? trim($r[$colMap['contact_person']]) : null,
                'contact_number' => isset($colMap['contact_number']) ? trim($r[$colMap['contact_number']]) : null,
            ];

            $data = [
                'name' => $prodName,
                'seller_name' => $arbo ?: null,
                'location' => trim(($municipality ? $municipality . ', ' : '') . ($province ?: '')),
                'status' => 'active',
                'description' => json_encode($meta, JSON_UNESCAPED_UNICODE),
            ];
            Product::updateOrCreate(['name' => $prodName, 'seller_name' => $arbo], $data);
            $count++;
        }
    }

    echo "Imported/updated {$count} products.\n";
    exit(0);

} catch (Throwable $e) {
    echo "Import failed: " . $e->getMessage() . "\n";
    exit(1);
}
