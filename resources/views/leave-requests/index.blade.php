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
                    <p class="text-subtitle text-muted">Handle Leave Requests data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Leave Requests</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Leave Request Management
                    </h5>
                    <a href="{{ route('leave-requests.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle bi-middle"></i> Create Leave Request
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
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                @if (session('role') == 'HR Manager')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">

                            @foreach ($leave_requests as $leave_request)
                                <tr>
                                    <td>{{ $leave_request->employee->fullname }}</td>
                                    <td>{{ $leave_request->leave_type }}</td>
                                    <td>{{ $leave_request->start_date->format('d-m-Y') }}</td>
                                    <td>{{ $leave_request->end_date->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($leave_request->status == 'pending')
                                            <span class="badge bg-warning">{{ $leave_request->status }}</span>
                                        @elseif ($leave_request->status == 'approved')
                                            <span class="badge bg-success">{{ $leave_request->status }}</span>
                                        @elseif ($leave_request->status == 'rejected')
                                            <span class="badge bg-danger">{{ $leave_request->status }}</span>
                                        @elseif ($leave_request->status == 'cancelled')
                                            <span class="badge bg-danger">{{ $leave_request->status }}</span>
                                        @endif
                                    </td>

                                    @if (session('role') == 'HR Manager')
                                        <td>
                                            <a href="{{ route('leave-requests.edit', ['leave_request' => $leave_request->id]) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form
                                                action="{{ route('leave-requests.destroy', ['leave_request' => $leave_request->id]) }}"
                                                method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')

                                                <button
                                                    onclick="return confirm('Are you sure you want to delete this Leave Request?')"
                                                    type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>

                                            <form
                                                action="{{ route('leave-requests.update-status', ['leave_request' => $leave_request->id]) }}"
                                                method="post" class="d-inline-block"
                                                {{ $leave_request->status == 'approved' ? 'hidden' : '' }}>
                                                @csrf
                                                @method('patch')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>

                                            <form
                                                action="{{ route('leave-requests.update-status', ['leave_request' => $leave_request->id]) }}"
                                                method="post" class="d-inline-block"
                                                {{ $leave_request->status == 'pending' ? 'hidden' : '' }}>
                                                @csrf
                                                @method('patch')
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="btn btn-warning btn-sm">Pending</button>
                                            </form>

                                            <form
                                                action="{{ route('leave-requests.update-status', ['leave_request' => $leave_request->id]) }}"
                                                method="post" class="d-inline-block"
                                                {{ $leave_request->status == 'rejected' ? 'hidden' : '' }}>
                                                @csrf
                                                @method('patch')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>

                                            <form
                                                action="{{ route('leave-requests.update-status', ['leave_request' => $leave_request->id]) }}"
                                                method="post" class="d-inline-block"
                                                {{ $leave_request->status == 'cancelled' ? 'hidden' : '' }}>
                                                @csrf
                                                @method('patch')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
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
