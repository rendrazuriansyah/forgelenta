{{-- {{ dd($departments) }} --}}

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
                    <h3>Departments</h3>
                    <p class="text-subtitle text-muted">Handle Departments data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Departments</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Department Management
                    </h5>
                    <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle bi-middle"></i> Create Department
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">

                            @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->description ?? '-' }}</td>

                                    <td>
                                        @if ($department->status == 'active')
                                            <span class="badge bg-success">{{ $department->status }}</span>
                                        @elseif ($department->status == 'inactive')
                                            <span class="badge bg-danger">{{ $department->status }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('departments.edit', ['department' => $department->id]) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('departments.destroy', ['department' => $department->id]) }}"
                                            method="post" class="d-inline-block">
                                            @csrf
                                            @method('delete')

                                            <button
                                                onclick="return confirm('Are you sure you want to delete this department?')"
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
