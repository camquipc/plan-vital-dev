<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@test.com';
        $user->password = 'admin';
        $user->role = 'admin';
        $user->save();

        $user = new User;
        $user->name = 'User';
        $user->email = 'user@test.com';
        $user->password = 'user';
        $user->role = 'user';
        $user->save();


        DB::table('estado_ejecutivos')->insert([
            ['estado' => 'Sano - Trabajando en Oficina'],
            ['estado' => 'Vacaciones'],
            ['estado' => 'Licencia Normal'],
        ]);
    }
}
