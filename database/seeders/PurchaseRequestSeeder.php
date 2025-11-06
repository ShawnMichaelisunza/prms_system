<?php

namespace Database\Seeders;

use App\Models\PurchaseRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseRequest::insert([
            [
                'user_id' => 1,
                'organization_id' => 1,
                'purpose' => 'Purchase office supplies',
                'pr_no' => 'PR-0001',
                'po_no' => 'No PO-NO',
                'rr_no' => 'No RR-NO',
                'pr_status' => 'PENDING',
            ],
            [
                'user_id' => 2,
                'organization_id' => 1,
                'purpose' => 'Order new laptops',
                'pr_no' => 'PR-0002',
                'po_no' => 'No PO-NO',
                'rr_no' => 'No RR-NO',
                'pr_status' => 'PENDING',
            ],
            [
                'user_id' => 1,
                'organization_id' => 1,
                'purpose' => 'Procurement of maintenance tools',
                'pr_no' => 'PR-0003',
                'po_no' => 'No PO-NO',
                'rr_no' => 'No RR-NO',
                'pr_status' => 'PENDING',
            ],
        ]);
    }
}
