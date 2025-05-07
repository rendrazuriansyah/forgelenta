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
                    <h3>Tasks</h3>
                    <p class="text-subtitle text-muted">Handle employees tasks</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Detail Task
                    </h5>
                </div>


                <div class="card-body">

                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label"><strong>Title</strong></label>
                        <div class="col-md-8">
                            <p class="form-control-plaintext">{{ $task->title }}</p>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label"><strong>Description</strong></label>
                        <div class="col-md-8">
                            <p class="form-control-plaintext">{{ $task->description }}</p>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label"><strong>Assigned To</strong></label>
                        <div class="col-md-8">
                            <p class="form-control-plaintext">{{ $task->employee->fullname }}</p>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label"><strong>Due Datetime</strong></label>
                        <div class="col-md-8">
                            <p class="form-control-plaintext">
                                {{ \Carbon\Carbon::parse($task->due_datetime)->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label"><strong>Status</strong></label>
                        <div class="col-md-8">
                            <p class="form-control-plaintext">
                                @switch($task->status)
                                    @case('pending')
                                        <span class="badge bg-secondary">Pending</span>
                                    @break

                                    @case('in progress')
                                        <span class="badge bg-primary">In Progress</span>
                                    @break

                                    @case('completed')
                                        <span class="badge bg-success">Completed</span>
                                    @break

                                    @case('overdue')
                                        <span class="badge bg-danger">Overdue</span>
                                    @break

                                    @default
                                        {{ ucfirst($task->status) }}
                                @endswitch
                            </p>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label"><strong>Created At</strong></label>
                        <div class="col-md-8">
                            <p class="form-control-plaintext">{{ $task->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label"><strong>Updated At</strong></label>
                        <div class="col-md-8">
                            <p class="form-control-plaintext">{{ $task->updated_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-primary">View Assigned Employee</a>
                        <a href="javascript:history.back()" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>


            </div>

        </section>
    </div>
@endsection
