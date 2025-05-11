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
                            <li class="breadcrumb-item active" aria-current="page">Tasks</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Task Management
                    </h5>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle bi-middle"></i> Create Task
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
                                <th>Title</th>
                                <th>Assigned To</th>
                                <th>Due Datetime</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">

                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->employee->fullname }}</td>
                                    <td>{{ $task->due_datetime->format('d-m-Y H:i') }}</td>

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
                                        <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"
                                            class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                        </form>

                                        {{-- Status Update Forms --}}
                                        @switch($task->status)
                                            @case('pending')
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="in progress">
                                                    <button type="submit" class="btn btn-primary btn-sm">Mark as In
                                                        Progress</button>
                                                </form>
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                                                </form>
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="overdue">
                                                    <button type="submit" class="btn btn-danger btn-sm">Mark as Overdue</button>
                                                </form>
                                            @break

                                            @case('in progress')
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit" class="btn btn-secondary btn-sm">Mark as Pending</button>
                                                </form>
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                                                </form>
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="overdue">
                                                    <button type="submit" class="btn btn-danger btn-sm">Mark as Overdue</button>
                                                </form>
                                            @break

                                            @case('completed')
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit" class="btn btn-secondary btn-sm">Mark as
                                                        Pending</button>
                                                </form>
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="in progress">
                                                    <button type="submit" class="btn btn-primary btn-sm">Mark as In
                                                        Progress</button>
                                                </form>
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="overdue">
                                                    <button type="submit" class="btn btn-danger btn-sm">Mark as
                                                        Overdue</button>
                                                </form>
                                            @break

                                            @case('overdue')
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit" class="btn btn-secondary btn-sm">Mark as
                                                        Pending</button>
                                                </form>
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="in progress">
                                                    <button type="submit" class="btn btn-primary btn-sm">Mark as In
                                                        Progress</button>
                                                </form>
                                                <form action="{{ route('tasks.update-status', ['task' => $task->id]) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="btn btn-success btn-sm">Mark as
                                                        Completed</button>
                                                </form>
                                            @break
                                        @endswitch
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
