<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ForgeLentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Departments
        $departments = [
            ['name' => 'HR', 'description' => 'Human Resources Department', 'status' => 'active'],
            ['name' => 'IT', 'description' => 'Information Technology Department', 'status' => 'active'],
            ['name' => 'Sales', 'description' => 'Sales and Marketing Department', 'status' => 'active'],
            ['name' => 'Finance', 'description' => 'Finance Department', 'status' => 'active'],
            ['name' => 'Marketing', 'description' => 'Marketing Department', 'status' => 'active'],
            ['name' => 'Operations', 'description' => 'Operations Department', 'status' => 'active'],
        ];

        foreach ($departments as $department) {
            DB::table('departments')->insert(array_merge($department, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        // Roles
        $roles = [
            ['title' => 'HR Manager', 'description' => 'Manages human resources activities'],
            ['title' => 'Software Engineer', 'description' => 'Develops and maintains software applications'],
            ['title' => 'Sales Manager', 'description' => 'Manages sales team and activities'],
            ['title' => 'Accountant', 'description' => 'Manages financial transactions and records'],
            ['title' => 'Marketing Specialist', 'description' => 'Develops and executes marketing campaigns'],
            ['title' => 'Operations Manager', 'description' => 'Oversees daily operations'],
            ['title' => 'Project Manager', 'description' => 'Manages projects from start to finish'],
            ['title' => 'Data Analyst', 'description' => 'Analyzes data to provide insights'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert(array_merge($role, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        // Employees
        for ($i = 0; $i < 75; $i++) {
            $department_id = $faker->numberBetween(1, count($departments));
            $role_id = $faker->numberBetween(1, count($roles));
            $hire_date = $faker->dateTimeBetween('-5 years', 'now');

            DB::table('employees')->insert([
                'fullname' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->dateTimeBetween('-40 years', '-20 years'),
                'hire_date' => $hire_date,
                'department_id' => $department_id,
                'role_id' => $role_id,
                'status' => $faker->randomElement(['active', 'inactive', 'on_leave']),
                'salary' => $faker->randomFloat(2, 50000, 150000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]);
        }

        // Tasks
        $employee_ids = DB::table('employees')->pluck('id')->toArray();
        for ($i = 0; $i < 150; $i++) {
            $assigned_to = $faker->randomElement($employee_ids);
            $due_date = Carbon::now()->addDays($faker->numberBetween(1, 60));

            DB::table('tasks')->insert([
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(),
                'assigned_to' => $assigned_to,
                'due_date' => $due_date,
                'status' => $faker->randomElement(['pending', 'in progress', 'completed', 'overdue']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Payrolls
        $employee_ids = DB::table('employees')->pluck('id')->toArray();
        foreach ($employee_ids as $employee_id) {
            $salary = $faker->randomFloat(2, 50000, 150000);
            $bonus = $faker->randomFloat(2, 0, 20000);
            $deductions = $faker->randomFloat(2, 0, 7000);
            $net_salary = $salary + $bonus - $deductions;
            $pay_date = Carbon::now()->subMonths($faker->numberBetween(0, 12));

            DB::table('payrolls')->insert([
                'employee_id' => $employee_id,
                'salary' => $salary,
                'bonus' => $bonus,
                'deductions' => $deductions,
                'net_salary' => $net_salary,
                'pay_date' => $pay_date,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Presences
        foreach ($employee_ids as $employee_id) {
            $start_date = Carbon::now()->subMonths(6);
            $end_date = Carbon::now();
            $current_date = $start_date->copy();

            while ($current_date->lte($end_date)) {
                if ($current_date->isWeekday()) { // Simulate workdays
                    $check_in = $current_date->copy()->setTime($faker->numberBetween(8, 9), $faker->numberBetween(0, 59), $faker->numberBetween(0, 59));
                    $check_out = $check_in->copy()->addHours($faker->numberBetween(6, 8));
                    $status = $faker->randomElement(['present', 'absent', 'late', 'early_leave']);

                    DB::table('presences')->insert([
                        'employee_id' => $employee_id,
                        'check_in' => $check_in,
                        'check_out' => $check_out,
                        'date' => $current_date->toDateString(),
                        'status' => $status,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
                $current_date->addDay();
            }
        }

        // Leave Requests
        $leave_types = ['Sick Leave', 'Vacation', 'Personal Leave', 'Maternity Leave', 'Paternity Leave'];
        for ($i = 0; $i < 30; $i++) {
            $employee_id = $faker->randomElement($employee_ids);
            $leave_type = $faker->randomElement($leave_types);
            $start_date = Carbon::now()->addDays($faker->numberBetween(1, 120));
            $end_date = $start_date->copy()->addDays($faker->numberBetween(1, 10));
            $status = $faker->randomElement(['pending', 'approved', 'rejected', 'cancelled']);

            DB::table('leave_requests')->insert([
                'employee_id' => $employee_id,
                'leave_type' => $leave_type,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'status' => $status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
