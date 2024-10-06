<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Edition;
use App\Models\Departaments;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $edition = Edition::create([
            'name' => 'SINF 2024',
            'year' => 2024,
        ]);
        /* DIDN'T TEST, THIS IS A REMINDER */
        Departaments::create([
            'name' => "-",
            'edition_id' => $edition->id
        ]);
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'usertype_id' => '0',
            'usertype_type' => Admin::class,
        ]);
        $admin = Admin::create(['user_id' => $user->id]);
        $user->usertype()->associate($admin);
        $user->save();
    }
}
