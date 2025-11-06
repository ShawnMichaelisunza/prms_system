<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $org = Organization::first();

        User::create([
            'name' => 'Shawn',
            'email' => 'shawn@yahoo.com',
            'organization_id' => $org ? $org->id : null,
            'password' => Hash::make('password'),
        ]);
    }
}
