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
                    <h3>Leave Requests</h3>
                    <p class="text-subtitle text-muted">Handle leave requests data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('leave-requests.index') }}">Leave Requests</a>
                            </li>
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
                        Edit Leave Request
                    </h5>
                </div>

                <div class="card-body">
                    <form class="form"
                        action="{{ route('leave-requests.update', ['leave_request' => $leave_request->id]) }}"
                        method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="employee_id" class="form-label">Employee</label>
                                    <select id="employee_id" class="form-control @error('employee_id') is-invalid @enderror"
                                        name="employee_id">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ old('employee_id', $leave_request->employee_id) == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->fullname }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="leave_type" class="form-label">Leave Type</label>
                                    <select id="leave_type" class="form-control @error('leave_type') is-invalid @enderror"
                                        name="leave_type">
                                        <option value="">Select Leave Type</option>
                                        @foreach ($leave_types as $leave_type)
                                            <option value="{{ $leave_type }}"
                                                {{ old('leave_type', $leave_request->leave_type) == $leave_type ? 'selected' : '' }}>
                                                {{ $leave_type }}</option>
                                        @endforeach
                                    </select>
                                    @error('leave_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="text" id="start_date"
                                        class="form-input flatpickr-input-date @error('start_date') is-invalid @enderror"
                                        name="start_date" placeholder="Select Date"
                                        value="{{ old('start_date', $leave_request->start_date) }}" readonly>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="text" id="end_date"
                                        class="form-input flatpickr-input-date @error('end_date') is-invalid @enderror"
                                        name="end_date" placeholder="Select Date"
                                        value="{{ old('end_date', $leave_request->end_date) }}" readonly>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" class="form-control @error('status') is-invalid @enderror"
                                        name="status">
                                        <option value="">Select Status</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}"
                                                {{ old('status', $leave_request->status) == $status ? 'selected' : '' }}>
                                                {{ $status }}</option>
                                        @endforeach
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
