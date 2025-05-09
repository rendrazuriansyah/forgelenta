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
                    <div class="row">
                        {{-- Title --}}
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" value="{{ $task->title }}" readonly>
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" readonly rows="3">{{ $task->description }}</textarea>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" value="{{ ucfirst($task->status) }}"
                                readonly>
                        </div>

                        {{-- Assigned To --}}
                        <div class="col-md-12 mb-3">
                            <label for="assigned_to" class="form-label">Assigned To</label>
                            <input type="text" class="form-control" id="assigned_to"
                                value="{{ $task->employee->fullname }}" readonly>
                        </div>

                        {{-- Due Datetime --}}
                        <div class="col-md-12 mb-3">
                            <label for="due_datetime" class="form-label">Due Datetime</label>
                            <input type="text" class="form-control" id="due_datetime"
                                value="{{ \Carbon\Carbon::parse($task->due_datetime)->format('d F Y H:i') }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
