// database/migrations/2025_05_01_132809_create_forgelenta.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address');
            $table->date('birth_date');
            $table->date('hire_date');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('role_id')->constrained('roles');
            $table->enum('status', ['active', 'inactive', 'on_leave'])->default('active');
            $table->decimal('salary', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            // assigned_to is employee_id
            $table->foreignId('assigned_to')->constrained('employees');
            $table->date('due_date');
            $table->enum('status', ['pending', 'in progress', 'completed', 'overdue'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->decimal('salary', 10, 2);
            $table->decimal('bonus', 10, 2)->nullable();
            $table->decimal('deductions', 10, 2)->nullable();
            $table->decimal('net_salary', 10, 2);
            $table->date('pay_date');
            $table->timestamps();
            $table->softDeletes();
            $table->index('employee_id');
        });

        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->dateTime('check_in');
            $table->dateTime('check_out')->nullable();
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'late', 'early_leave'])->default('absent');
            $table->timestamps();
            $table->softDeletes();
            $table->index('employee_id');
        });

        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->string('leave_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
            $table->index('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('payrolls');
        Schema::dropIfExists('presences');
        Schema::dropIfExists('leave_requests');
    }
};
