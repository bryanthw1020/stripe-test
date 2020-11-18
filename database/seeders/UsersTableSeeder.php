<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersData = collect([
            [
                'name' => 'SGPAY',
                'email' => 'sgpay@curewards.store',
                'email_verified_at' => now(),
                'password' => bcrypt(123456),
            ]
        ]);

        $usersData->each(function ($userData) {
            User::updateOrCreate(['email' => $userData['email']], $userData);
        });
    }
}
