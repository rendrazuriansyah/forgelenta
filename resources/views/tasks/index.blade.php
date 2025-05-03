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
                            <li class="breadcrumb-item active" aria-current="page""><a
                                    href="{{ route('tasks.index') }}">Tasks</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Data.
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-4 ms-auto">New Task</a>
                    </div>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->employee->fullname }}</td>
                                    <td>{{ $task->due_datetime }}</td>

                                    <td>
                                        @if ($task->status == 'pending')
                                            <span class="badge bg-secondary">Pending</span>
                                        @elseif ($task->status == 'in progress')
                                            <span class="badge bg-primary">In Progress</span>
                                        @elseif ($task->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif ($task->status == 'overdue')
                                            <span class="badge bg-danger">Overdue</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="" class="btn btn-info btn-sm">View</a>
                                        <a href="" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="" class="btn btn-danger btn-sm">Delete</a>

                                        @if ($task->status == 'pending')
                                            <a href="" class="btn btn-primary btn-sm mb-1">Mark as in
                                                Progress</a>
                                            <a href="" class="btn btn-success btn-sm mb-1">Mark as Completed</a>
                                        @elseif ($task->status == 'in progress')
                                            <a href="" class="btn btn-secondary btn-sm mb-1">Mark as Pending</a>
                                            <a href="" class="btn btn-success btn-sm mb-1">Mark as Completed</a>
                                        @elseif ($task->status == 'completed')
                                            <a href="" class="btn btn-secondary btn-sm mb-1">Mark as Pending</a>
                                            <a href="" class="btn btn-primary btn-sm mb-1">Mark as in
                                                Progress</a>
                                        @elseif ($task->status == 'overdue')
                                            <a href="" class="btn btn-secondary btn-sm mb-1">Mark as Pending</a>
                                            <a href="" class="btn btn-primary btn-sm mb-1">Mark as in
                                                Progress</a>
                                            <a href="" class="btn btn-success btn-sm mb-1">Mark as Completed</a>
                                        @endif

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
