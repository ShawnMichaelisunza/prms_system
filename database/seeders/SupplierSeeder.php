<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            [
                'supplier_name' => 'ABC Supplies Ltd.',
                'supplier_type' => 'Electronics',
                'address' => '123 Main Street, Cityville',
                'contact' => 987654321,
            ],
            [
                'supplier_name' => 'Global Traders Inc.',
                'supplier_type' => 'Furniture',
                'address' => '45 Oak Avenue, Metropolis',
                'contact' => 912345678,
            ],
            [
                'supplier_name' => 'FreshFarm Produce',
                'supplier_type' => 'Agriculture',
                'address' => '789 Green Road, Countryside',
                'contact' => 998877665,
            ],
        ]);
    }
}
