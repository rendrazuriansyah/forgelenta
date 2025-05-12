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
                    <p class="text-subtitle text-muted">Detail payroll data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payrolls</a></li>
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
                        Detail Payroll
                    </h5>
                </div>

                <div class="card-body">
                    <div id="printableArea">
                        <div class="row">
                            <div class="col-md-12 col-12 mb-3">
                                <label for="employee_id" class="form-label">Employee</label>
                                <input type="text" id="employee_id" class="form-control"
                                    value="{{ $payroll->employee->fullname }}" readonly>
                            </div>
                            <div class="col-md-12 col-12 mb-3">
                                <label for="salary" class="form-label">Salary</label>
                                <input type="text" id="salary" class="form-control"
                                    value="{{ number_format($payroll->salary, 2) }}" readonly>
                            </div>
                            <div class="col-md-12 col-12 mb-3">
                                <label for="bonus" class="form-label">Bonus</label>
                                <input type="text" id="bonus" class="form-control"
                                    value="{{ number_format($payroll->bonus, 2) }}" readonly>
                            </div>
                            <div class="col-md-12 col-12 mb-3">
                                <label for="deductions" class="form-label">Deductions</label>
                                <input type="text" id="deductions" class="form-control"
                                    value="{{ number_format($payroll->deductions, 2) }}" readonly>
                            </div>
                            <div class="col-md-12 col-12 mb-3">
                                <label for="net_salary" class="form-label">Net Salary</label>
                                <input type="text" id="net_salary" class="form-control"
                                    value="{{ number_format($payroll->net_salary, 2) }}" readonly>
                            </div>
                            <div class="col-md-12 col-12 mb-3">
                                <label for="pay_date" class="form-label">Pay Date</label>
                                <input type="text" id="pay_date" class="form-control"
                                    value="{{ $payroll->pay_date->format('d F Y') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary me-1 mb-1" onclick="printPayroll()">
                                Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function printPayroll() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents; // Timpa body dengan konten yg mau diprint

            window.print(); // Panggil fungsi print browser

            document.body.innerHTML = originalContents; // Kembalikan body ke konten semula
        }
    </script>
@endsection
