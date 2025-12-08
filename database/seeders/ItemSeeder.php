<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::insert([
            [
                'user_id' => 1,
                'supplier_id' => 1,
                'item_name' => 'Premium Coffee Beans',
                'item_image' => 'item_images/ballpen.png',
                'item_uom' => 'kg',
                'price' => 25.50,
            ],
            [
                'user_id' => 2,
                'supplier_id' => 1,
                'item_name' => 'Organic Green Tea',
                'item_image' => 'item_images/keyboard.png',
                'item_uom' => 'box',
                'price' => 12.75,
            ],
            [
                'user_id' => 1,
                'supplier_id' => 2,
                'item_name' => 'Baking Flour',
                'item_image' => 'item_images/laptop.png',
                'item_uom' => 'kg',
                'price' => 8.20,
            ],
            [
                'user_id' => 1,
                'supplier_id' => 3,
                'item_name' => 'Baking Flour',
                'item_image' => 'item_images/mouse.png',
                'item_uom' => 'kg',
                'price' => 8.20,
            ],
            [
                'user_id' => 1,
                'supplier_id' => 3,
                'item_name' => 'Baking Flour',
                'item_image' => 'item_images/tape.png',
                'item_uom' => 'kg',
                'price' => 8.20,
            ],
        ]);
    }
}
