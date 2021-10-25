<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'rathoreankit582@gmail.com',
                'password' => Hash::make('12345678')
            ]
        );
        User::find($user->id)->assignRole('Super Admin');
    }
}
