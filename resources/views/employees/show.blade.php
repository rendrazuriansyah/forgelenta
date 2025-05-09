@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Employees</h3>
                    <p class="text-subtitle text-muted">Handle employees data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Detail Employee
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Personal Info --}}
                        <div class="col-md-6 mb-3">
                            <label for="fullname" class="form-label">Fullname</label>
                            <input type="text" class="form-control" id="fullname" value="{{ $employee->fullname }}"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" value="{{ $employee->email }}"
                                readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" value="{{ $employee->phone_number }}"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="gender" value="{{ $employee->gender ?? '-' }}"
                                readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="text" class="form-control" id="birthday"
                                value="{{ $employee->birth_date ? $employee->birth_date->format('d F Y') : '-' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status"
                                value="{{ ucfirst(str_replace('_', ' ', $employee->status)) ?? '-' }}" readonly>
                        </div>

                        {{-- Address takes full width --}}
                        <div class="col-md-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" rows="3" readonly>{{ $employee->address }}</textarea>
                        </div>

                        {{-- Employment Info --}}
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control" id="department"
                                value="{{ $employee->department->name ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role"
                                value="{{ $employee->role->title ?? '-' }}" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="hire_date" class="form-label">Hire Date</label>
                            <input type="text" class="form-control" id="hire_date"
                                value="{{ $employee->hire_date ? $employee->hire_date->format('d F Y') : '-' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="text" class="form-control" id="salary"
                                value="{{ number_format($employee->salary, 2) }}" readonly>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
