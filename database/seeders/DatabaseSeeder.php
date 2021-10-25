<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleAndPermissionSeeder::class);
        $user = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'rathoreankit582@gmail.com',
                'password' => Hash::make('12345678')
            ]
        );
        User::find($user->id)->assignRole('Super Admin');
        $user = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678')
            ]
        );
        User::find($user->id)->assignRole('Admin');
        $user = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678')
            ]
        );
        User::find($user->id)->assignRole('User');
    }
}
