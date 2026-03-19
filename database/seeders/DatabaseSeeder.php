<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seed roles first
        $this->call(RolesTableSeeder::class);

        // Find super admin role id
        $super = DB::table('roles')->where('slug', 'super_admin')->first();

        $existing = User::where('email', 'test@example.com')->first();
        if ($existing) {
            $existing->update([
                'role_id' => $super?->id,
                'is_verified' => true,
            ]);
        } else {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'role_id' => $super?->id,
                'is_verified' => true,
            ]);
        }
    }
}
