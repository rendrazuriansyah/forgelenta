@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            {{-- <i class="iconly-boldShow"></i> --}}
                                            <i class="bi bi-building-fill"
                                                style="font-size: 1.5rem; color: white; margin-left: -0.5rem; margin-top: -1.3rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Departments</h6>
                                        <h6 class="font-extrabold mb-0">{{ $department }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            {{-- <i class="iconly-boldProfile"></i> --}}
                                            <i class="bi bi-people-fill"
                                                style="font-size: 1.5rem; color: white; margin-left: -0.5rem; margin-top: -1.3rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Employees</h6>
                                        <h6 class="font-extrabold mb-0">{{ $employee }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            {{-- <i class="iconly-boldAdd-User"></i> --}}
                                            <i class="bi bi-currency-exchange"
                                                style="font-size: 1.5rem; color: white; margin-left: -0.5rem; margin-top: -1.3rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Payrolls</h6>
                                        <h6 class="font-extrabold mb-0">{{ $payroll }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            {{-- <i class="iconly-boldBookmark"></i> --}}
                                            <i class="bi bi-calendar-check-fill"
                                                style="font-size: 1.5rem; color: white; margin-left: -0.5rem; margin-top: -1.3rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Presences</h6>
                                        <h6 class="font-extrabold mb-0">{{ $presence }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Presences</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>5 Latest Tasks</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Assigned to</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $task)
                                                <tr>
                                                    <td class="col-4">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="https://ui-avatars.com/api/?name={{ $task->employee->fullname }}&color=333333&background=FFFFFF"
                                                                    style="border: 1px solid #333333">
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">{{ $task->employee->fullname }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{ $task->title }}</p>
                                                    </td>
                                                    <td class="col-auto">
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
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="text-center">
                            <div class="avatar avatar-xl mb-3">
                                <img src="{{ asset('mazer/assets/compiled/jpg/1.jpg') }}" alt="Face 1">
                            </div>
                            <div class="name">
                                <h6 class="font-bold">{{ $me->fullname }}</h6>
                                <h6 class="text-muted mb-0">{{ $me->role->title }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Presences Profile</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-visitors-profile"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
