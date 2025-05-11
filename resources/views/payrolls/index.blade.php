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
                    <h3>Payrolls</h3>
                    <p class="text-subtitle text-muted">Handle Payrolls data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payrolls</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Payroll Management
                    </h5>
                    <a href="{{ route('payrolls.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle bi-middle"></i> Create Payroll
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
                                <th>Employee</th>
                                <th>Salary ($)</th>
                                <th>Bonus ($)</th>
                                <th>Deductions ($)</th>
                                <th>Net Salary ($)</th>
                                <th>Pay Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">

                            @foreach ($payrolls as $payroll)
                                <tr>
                                    <td>{{ $payroll->employee->fullname }}</td>
                                    <td>{{ number_format($payroll->salary, 2, ',', '.') }}</td>
                                    <td>{{ number_format($payroll->bonus, 2, ',', '.') }}</td>
                                    <td>{{ number_format($payroll->deductions, 2, ',', '.') }}</td>
                                    <td>{{ number_format($payroll->net_salary, 2, ',', '.') }}</td>
                                    <td>{{ $payroll->pay_date->format('d-m-Y') }}</td>

                                    <td>
                                        <a href="{{ route('payrolls.edit', ['payroll' => $payroll->id]) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('payrolls.destroy', ['payroll' => $payroll->id]) }}"
                                            method="post" class="d-inline-block">
                                            @csrf
                                            @method('delete')

                                            <button
                                                onclick="return confirm('Are you sure you want to delete this payroll?')"
                                                type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
