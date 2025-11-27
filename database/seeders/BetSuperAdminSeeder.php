<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class BetSuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'  => 'BET.SUPERADMIN1',
            'password'  => '12345678', // otomatis di-hash oleh mutator di model
            'role'      => 'SUPERADMIN',
            'isActive'  => 1,
            'createdAt' => Carbon::now(),
            'updatedAt' => Carbon::now(),
        ]);
    }
}
