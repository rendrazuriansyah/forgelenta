<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run ForgeLentaSeeder
        $this->call(ForgeLentaSeeder::class);

        // Create Test User
        // User::factory(10)->create();
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Assign an employee_id to the test user with HR Manager role
        $hrManager = DB::table('employees')
            ->join('roles', 'employees.role_id', '=', 'roles.id')
            ->where('roles.title', 'HR Manager')
            ->first();

        if ($hrManager) {
            $testUser->employee_id = $hrManager->id;
            $testUser->save();
        }
    }
}
