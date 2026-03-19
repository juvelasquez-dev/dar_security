<?php

namespace App\Http\Controllers\Carpos;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CarposManagementController extends Controller
{
    /**
     * Display ARBO Management page.
     */
    public function index()
    {
        // Dashboard stat cards
        $totalArbos = 6;
        $activeArbos = 3;
        $pendingArbos = 2;
        $inactiveArbos = 1;

        // Sample ARBO list (matches your blade structure)
        $arbosCollection = collect([
            (object)[
                'id' => 1,
                'arbo_id' => 'ARBO-0001',
                'name' => 'Mabuhay Farmers Cooperative',
                'type' => 'Multi-Purpose Cooperative',
                'province' => 'Camarines Sur',
                'municipality' => 'Naga City',
                'barangay' => 'Triangulo',
                'registration_number' => 'CDA-2024-0001',
                'contact_person' => 'Juan dela Cruz',
                'status' => 'active',
                'created_at' => now()->subDays(120)
            ],
            (object)[
                'id' => 2,
                'arbo_id' => 'ARBO-0002',
                'name' => 'Bagong Pag-asa ARB Association',
                'type' => 'Farmers Association',
                'province' => 'Albay',
                'municipality' => 'Legazpi City',
                'barangay' => 'Banquerohan',
                'registration_number' => 'CDA-2024-0002',
                'contact_person' => 'Maria Santos',
                'status' => 'active',
                'created_at' => now()->subDays(100)
            ],
            (object)[
                'id' => 3,
                'arbo_id' => 'ARBO-0003',
                'name' => 'Pagkakaisa Farmers Association',
                'type' => 'Farmers Association',
                'province' => 'Sorsogon',
                'municipality' => 'Sorsogon City',
                'barangay' => 'Balogo',
                'registration_number' => 'CDA-2024-0003',
                'contact_person' => 'Pedro Reyes',
                'status' => 'pending',
                'created_at' => now()->subDays(80)
            ],
            (object)[
                'id' => 4,
                'arbo_id' => 'ARBO-0004',
                'name' => 'Catanduanes ARB Cooperative',
                'type' => 'Multi-Purpose Cooperative',
                'province' => 'Catanduanes',
                'municipality' => 'Virac',
                'barangay' => 'Concepcion',
                'registration_number' => 'CDA-2024-0004',
                'contact_person' => 'Rosa Bautista',
                'status' => 'active',
                'created_at' => now()->subDays(60)
            ],
            (object)[
                'id' => 5,
                'arbo_id' => 'ARBO-0005',
                'name' => 'Masbate Agrarian Reform Cooperative',
                'type' => 'Agrarian Reform Cooperative',
                'province' => 'Masbate',
                'municipality' => 'Masbate City',
                'barangay' => 'Nursery',
                'registration_number' => 'CDA-2024-0005',
                'contact_person' => 'Carlos Mendoza',
                'status' => 'inactive',
                'created_at' => now()->subDays(40)
            ],
            (object)[
                'id' => 6,
                'arbo_id' => 'ARBO-0006',
                'name' => 'CamNorte Farmers Coop',
                'type' => 'Multi-Purpose Cooperative',
                'province' => 'Camarines Norte',
                'municipality' => 'Daet',
                'barangay' => 'Lag-on',
                'registration_number' => 'CDA-2024-0006',
                'contact_person' => 'Linda Pascual',
                'status' => 'pending',
                'created_at' => now()->subDays(20)
            ]
        ]);

        // Paginate the sample collection so view pagination helpers work
        $page = request()->get('page', 1);
        $perPage = 10;
        $items = $arbosCollection->forPage($page, $perPage)->values();

        $arbos = new LengthAwarePaginator(
            $items,
            $arbosCollection->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        // Sample available ARBO admins
        $availableAdmins = collect([
            (object)[
                'id' => 1,
                'name' => 'Juan dela Cruz',
                'email' => 'jdelacruz@dar.gov.ph'
            ],
            (object)[
                'id' => 2,
                'name' => 'Maria Santos',
                'email' => 'msantos@dar.gov.ph'
            ],
            (object)[
                'id' => 3,
                'name' => 'Pedro Reyes',
                'email' => 'preyes@dar.gov.ph'
            ]
        ]);

        return view('carpos.carposmanagement.carposmanagement', compact(
            'totalArbos',
            'activeArbos',
            'pendingArbos',
            'inactiveArbos',
            'arbos',
            'availableAdmins'
        ));
    }
}