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
                    <h3>Roles</h3>
                    <p class="text-subtitle text-muted">Handle presences data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('presences.index') }}">Roles</a></li>
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
                        Edit Presence
                    </h5>
                </div>

                <div class="card-body">
                    <form class="form" action="{{ route('presences.update', ['presence' => $presence->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="employee_id" class="form-label">Employee</label>
                                    <select id="employee_id" class="form-control @error('employee_id') is-invalid @enderror"
                                        placeholder="employee_id" name="employee_id">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option
                                                value="{{ $employee->id }} {{ old('employee_id', $presence->employee_id) == $employee->id ? 'selected' : '' }}">
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
                                    <label for="check_in" class="form-label">Check in</label>
                                    <input type="text" id="check_in"
                                        class="form-control flatpickr-input-datetime @error('check_in') is-invalid @enderror"
                                        name="check_in" placeholder="Select datetime"
                                        value="{{ old('check_in', $presence->check_in) }}" readonly>
                                    @error('check_in')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="check_out" class="form-label">Check in</label>
                                    <input type="text" id="check_out"
                                        class="form-control flatpickr-input-datetime @error('check_out') is-invalid @enderror"
                                        name="check_out" placeholder="Select datetime"
                                        value="{{ old('check_out', $presence->check_out) }}" readonly>
                                    @error('check_out')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="text" id="date"
                                        class="form-control flatpickr-input-date @error('date') is-invalid @enderror"
                                        name="date" placeholder="Select date" value="{{ old('date', $presence->date) }}"
                                        readonly>
                                    @error('date')
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
                                        <option value="present" {{ $presence->status == 'present' ? 'selected' : '' }}>
                                            Present</option>
                                        <option value="absent" {{ $presence->status == 'absent' ? 'selected' : '' }}>Absent
                                        </option>
                                        <option value="late" {{ $presence->status == 'late' ? 'selected' : '' }}>Late
                                        </option>
                                        <option value="early_leave"
                                            {{ $presence->status == 'early_leave' ? 'selected' : '' }}>Early Leave</option>
                                    </select>
                                    @error('status')
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
