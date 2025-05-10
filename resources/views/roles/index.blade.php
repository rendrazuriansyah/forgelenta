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
                    <p class="text-subtitle text-muted">Handle Roles data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Roles</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Role Management
                    </h5>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle bi-middle"></i> Create Role
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
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">

                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->title }}</td>
                                    <td>{{ $role->description ?? '-' }}</td>

                                    <td>
                                        <a href="{{ route('roles.edit', ['role' => $role->id]) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('roles.destroy', ['role' => $role->id]) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            @method('delete')

                                            <button onclick="return confirm('Are you sure you want to delete this role?')"
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
