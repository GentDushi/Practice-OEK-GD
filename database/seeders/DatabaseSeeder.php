<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'name' => 'Linux Box 10',
                'price' => '10',
                'image_path' => 'images/linux_logo.png'
            ],
            [
                'name' => 'Windows Box 10',
                'price' => '100',
                'image_path' => 'images/windows_logo.png'
            ]
        ];

        $user = [
            [
                'email' => 'gentdushi@protonmail.ch',
                'password' => bcrypt('12'),
            ],
        ];

        foreach ($product as $key => $item) {
            Product::create($item);
        }

        foreach ($user as $key => $item) {
            User::create($item);
        }

    }
}
