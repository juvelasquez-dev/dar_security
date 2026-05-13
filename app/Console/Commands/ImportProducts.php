<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportProducts extends Command
{
    protected $signature = 'import:products {file=storage/app/imports/Region 5 -ARBOs Products.xlsx'};
    protected $description = 'Import products from an Excel file into the products table';

    public function handle()
    {
        $file = $this->argument('file');

        // If user provided a storage path key, allow `imports/filename.xlsx`
        if (strpos($file, 'storage/app/') === 0) {
            $filePath = base_path(substr($file, strlen('storage/app/')));
        } else {
            $filePath = base_path($file);
        }

        if (!file_exists($filePath)) {
            // allow storage_path path
            $alt = storage_path('app/imports/Region 5 -ARBOs Products.xlsx');
            if (file_exists($alt)) {
                $filePath = $alt;
            } else {
                $this->error("File not found: {$filePath}");
                $this->line('Place the Excel file at `storage/app/imports/` and run:');
                $this->line('  php artisan import:products "storage/app/imports/Region 5 -ARBOs Products.xlsx"');
                return 1;
            }
        }

        if (!class_exists('\PhpOffice\\PhpSpreadsheet\\IOFactory')) {
            $this->error('PhpSpreadsheet is not installed. Run: composer require phpoffice/phpspreadsheet');
            return 1;
        }

        try {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($filePath);
            $spreadsheet = $reader->load($filePath);
            $sheet = $spreadsheet->getActiveSheet();

            $rows = $sheet->toArray(null, true, true, true);

            // Expect header row in first row - map columns by header name
            $header = [];
            if (count($rows) === 0) {
                $this->error('No rows found in spreadsheet');
                return 1;
            }

            $first = array_shift($rows);
            foreach ($first as $col => $value) {
                $h = trim(strtolower($value));
                $header[$col] = $h;
            }

            $count = 0;
            foreach ($rows as $r) {
                $data = [];
                // common columns: name, sku, category, price, unit, seller, location, stock, description, status
                foreach ($header as $col => $h) {
                    $val = isset($r[$col]) ? trim($r[$col]) : null;
                    switch ($h) {
                        case 'name':
                        case 'product name':
                            $data['name'] = $val; break;
                        case 'sku':
                            $data['sku'] = $val; break;
                        case 'category':
                            $data['category'] = $val; break;
                        case 'price':
                            $data['price'] = is_numeric($val) ? $val : 0; break;
                        case 'unit':
                            $data['unit'] = $val; break;
                        case 'seller':
                        case 'seller name':
                            $data['seller_name'] = $val; break;
                        case 'location':
                            $data['location'] = $val; break;
                        case 'stock':
                            $data['stock'] = is_numeric($val) ? intval($val) : 0; break;
                        case 'description':
                            $data['description'] = $val; break;
                        case 'status':
                            $data['status'] = $val ?: 'active'; break;
                    }
                }

                if (empty($data['name'])) {
                    continue;
                }

                Product::updateOrCreate([
                    'sku' => $data['sku'] ?? null,
                    'name' => $data['name']
                ], $data);

                $count++;
            }

            $this->info("Imported/updated {$count} products.");
            return 0;

        } catch (\Throwable $e) {
            $this->error('Import failed: ' . $e->getMessage());
            return 1;
        }
    }
}
