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
                    <h3>Presences</h3>
                    <p class="text-subtitle text-muted">Handle Presences data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Presences</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Presence Management
                    </h5>
                    <a href="{{ route('presences.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle bi-middle"></i> Create Presence
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
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Date</th>
                                <th>Status</th>
                                @if (session('role') == 'HR Manager')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">

                            @foreach ($presences as $presence)
                                <tr>
                                    <td>{{ $presence->employee->fullname }}</td>
                                    <td>{{ $presence->check_in->format('d-m-Y H:i') }}</td>
                                    <td>{{ $presence->check_out ? $presence->check_out->format('d-m-Y H:i') : '-' }}</td>
                                    <td>{{ $presence->date->format('d-m-Y') }}</td>
                                    <td>
                                        @switch($presence->status)
                                            @case('present')
                                                <span class="badge bg-success">Present</span>
                                            @break

                                            @case('absent')
                                                <span class="badge bg-danger">Absent</span>
                                            @break

                                            @case('late')
                                                <span class="badge bg-warning">Late</span>
                                            @break

                                            @case('early_leave')
                                                <span class="badge bg-info">Early Leave</span>
                                            @break
                                        @endswitch
                                    </td>

                                    @if (session('role') == 'HR Manager')
                                        <td>
                                            <a href="{{ route('presences.edit', ['presence' => $presence->id]) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('presences.destroy', ['presence' => $presence->id]) }}"
                                                method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')

                                                <button
                                                    onclick="return confirm('Are you sure you want to delete this presence?')"
                                                    type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
