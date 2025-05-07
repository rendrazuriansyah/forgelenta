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
                            <li class="breadcrumb-item active" aria-current="page">Employees</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Employee Management
                    </h5>
                    <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle bi-middle"></i> Create Emloyee
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('success-alert').style.display = 'none';
                            }, 5000);
                        </script>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead class="text-nowrap">
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Birth Date</th>
                                <th>Hire Date</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Salary ($)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">

                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->fullname }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone_number }}</td>
                                    <td>{{ $employee->birth_date->format('d-m-Y') }}</td>
                                    <td>{{ $employee->hire_date->format('d-m-Y') }}</td>
                                    <td>{{ $employee->department->name }}</td>
                                    <td>{{ $employee->role->name }}</td>
                                    <td>{{ $employee->status }}</td>

                                    <td>
                                        @if ($employee->status == 'active')
                                            <span class="badge bg-success">{{ $employee->status }}</span>
                                        @elseif ($employee->status == 'inactive')
                                            <span class="badge bg-secondary">{{ $employee->status }}</span>
                                        @elseif ($employee->status == 'on_leave')
                                            <span class="badge bg-warning">{{ $employee->status }}</span>
                                        @endif
                                    </td>

                                    <td>{{ $employee->salary }}</td>

                                    <td>ini ntar ada buttonnya</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
