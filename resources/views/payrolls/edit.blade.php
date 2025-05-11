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
                    <p class="text-subtitle text-muted">Handle payrolls data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payrolls</a></li>
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
                        Edit Payroll
                    </h5>
                </div>

                <div class="card-body">
                    <form class="form" action="{{ route('payrolls.update', ['payroll' => $payroll->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="employee_id" class="form-label">Employee</label>
                                    <select id="employee_id" class="form-control @error('employee_id') is-invalid @enderror"
                                        name="employee_id">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ old('employee_id', $payroll->employee_id) == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->fullname }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="number" id="salary"
                                        class="form-control @error('salary') is-invalid @enderror" name="salary"
                                        placeholder="Input salary" value="{{ old('salary', $payroll->salary) }}">
                                    @error('salary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="bonus" class="form-label">Bonus</label>
                                    <input type="number" id="bonus"
                                        class="form-control @error('bonus') is-invalid @enderror" name="bonus"
                                        placeholder="Input bonus" value="{{ old('bonus', $payroll->bonus) }}">
                                    @error('bonus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="deductions" class="form-label">Deductions</label>
                                    <input type="number" id="deductions"
                                        class="form-control @error('deductions') is-invalid @enderror" name="deductions"
                                        placeholder="Input deductions"
                                        value="{{ old('deductions', $payroll->deductions) }}">
                                    @error('deductions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="net_salary" class="form-label">Net Salary</label>
                                    <input type="number" id="net_salary"
                                        class="form-control @error('net_salary') is-invalid @enderror" name="net_salary"
                                        placeholder="0" value="{{ old('net_salary', $payroll->net_salary) }}" readonly>
                                    @error('net_salary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <script>
                                        /**
                                         * Calculates the net salary based on user input and sets the 'net_salary' input
                                         * value to the calculated result.
                                         */
                                        function calculateNetSalary() {
                                            /**
                                             * Get the input elements and their values (or 0 if empty)
                                             * @type {HTMLInputElement}
                                             */
                                            const inputSalary = document.getElementById('salary');
                                            const inputBonus = document.getElementById('bonus');
                                            const inputDeductions = document.getElementById('deductions');
                                            const inputNetSalary = document.getElementById('net_salary');

                                            /**
                                             * Calculate the net salary by adding salary and bonus, then subtracting deductions.
                                             * @type {number}
                                             */
                                            const salary = parseFloat(inputSalary.value) || 0;
                                            const bonus = parseFloat(inputBonus.value) || 0;
                                            const deductions = parseFloat(inputDeductions.value) || 0;
                                            const netSalary = salary + bonus - deductions;

                                            // Display the calculated value, but the actual value is calculated in backend
                                            inputNetSalary.value = netSalary.toFixed(2);
                                        }

                                        // Initial calculation on page load, using current values
                                        calculateNetSalary();

                                        // Add event listeners to recalculate on input change
                                        document.getElementById('salary').addEventListener('input', calculateNetSalary);
                                        document.getElementById('bonus').addEventListener('input', calculateNetSalary);
                                        document.getElementById('deductions').addEventListener('input', calculateNetSalary);
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pay_date" class="form-label">Pay Date</label>
                                    <input type="text" id="pay_date"
                                        class="form-control flatpickr-input-date @error('pay_date') is-invalid @enderror"
                                        name="pay_date" placeholder="Select Date"
                                        value="{{ old('pay_date', $payroll->pay_date) }}" readonly>
                                    @error('pay_date')
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
