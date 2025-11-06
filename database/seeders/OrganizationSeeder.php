<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::insert([
            [
                'acronym' => 'UN',
                'organization_name' => 'United Nations',
                'organization_address' => '405 East 42nd Street, New York, NY, USA',
            ],
            [
                'acronym' => 'WHO',
                'organization_name' => 'World Health Organization',
                'organization_address' => 'Avenue Appia 20, 1211 Geneva, Switzerland',
            ],
            [
                'acronym' => 'UNESCO',
                'organization_name' => 'United Nations Educational, Scientific and Cultural Organization',
                'organization_address' => '7 Place de Fontenoy, 75007 Paris, France',
            ],
        ]);
    }
}
