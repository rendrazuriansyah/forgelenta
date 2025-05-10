{{-- {{ dd($employee) }} --}}

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
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Edit Employee
                    </h5>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="form" action="{{ route('employees.update', ['employee' => $employee->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="full-name" class="form-label">Full Name</label>
                                    <input type="text" id="full-name"
                                        class="form-control @error('fullname') is-invalid @enderror" placeholder="Full Name"
                                        name="fullname" value="{{ old('fullname', $employee->fullname) }}">
                                    @error('fullname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder="email@example.com" value="{{ old('email', $employee->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="tel" id="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        placeholder="123-456-7890"
                                        value="{{ old('phone_number', $employee->phone_number) }}">
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address"
                                        placeholder="Street Address, City, State, Zip Code" rows="3">{{ old('address', $employee->address) }}
                                    </textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="birth_date" class="form-label">Birth Date</label>
                                    <input type="text" id="birth_date"
                                        class="form-control flatpickr-input-date @error('birth_date') is-invalid @enderror"
                                        name="birth_date" placeholder="yyyy-mm-dd"
                                        value="{{ old('birth_date', $employee->birth_date) }}" readonly="readonly">
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="hire_date" class="form-label">Hire Date</label>
                                    <input type="text" id="hire_date"
                                        class="form-control flatpickr-input-date @error('hire_date') is-invalid @enderror"
                                        name="hire_date" placeholder="yyyy-mm-dd"
                                        value="{{ old('hire_date', $employee->hire_date) }}" readonly="readonly">
                                    @error('hire_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="department" class="form-label">Department</label>
                                    <select id="department"
                                        class="form-control @error('department_id') is-invalid @enderror"
                                        placeholder="Department" name="department_id">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="role" class="form-label">Role</label>
                                    <select id="role" class="form-control @error('role_id') is-invalid @enderror"
                                        placeholder="Role" name="role_id">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ old('role_id', $employee->role_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" class="form-control @error('status') is-invalid @enderror"
                                        placeholder="status" name="status">
                                        <option value="">Select Status</option>
                                        @foreach ($statusOptions as $status)
                                            <option value="{{ $status }}"
                                                {{ old('status', $employee->status) == $status ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="number" id="salary"
                                        class="form-control @error('salary') is-invalid @enderror" name="salary"
                                        placeholder="Salary (USD)" value="{{ old('salary', $employee->salary) }}">

                                    @error('salary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
