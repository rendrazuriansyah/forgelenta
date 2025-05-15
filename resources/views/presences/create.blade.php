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
                    <p class="text-subtitle text-muted">Handle presences data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presences</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Create Presence
                    </h5>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('role') == 'HR Manager')
                        <form class="form" action="{{ route('presences.store') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="employee_id" class="form-label">Employee</label>
                                        <select id="employee_id"
                                            class="form-control @error('employee_id') is-invalid @enderror"
                                            name="employee_id">
                                            <option value="" selected disabled>Select an employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->fullname }}</option>
                                            @endforeach
                                        </select>
                                        {{-- @error('employee_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="check_in" class="form-label">Check in</label>
                                        <input type="text" id="check_in"
                                            class="form-control flatpickr-input-datetime @error('check_in') is-invalid @enderror"
                                            name="check_in" placeholder="Enter Check-in Time" value="{{ old('check_in') }}"
                                            readonly>
                                        {{-- @error('check_in')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="check_out" class="form-label">Check out</label>
                                        <input type="text" id="check_out"
                                            class="form-control flatpickr-input-datetime @error('check_out') is-invalid @enderror"
                                            name="check_out" placeholder="Enter Check-out Time"
                                            value="{{ old('check_out') }}" readonly>
                                        {{-- @error('check_out')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="text" id="date"
                                            class="form-control flatpickr-input-date @error('date') is-invalid @enderror"
                                            name="date" placeholder="Select date" value="{{ old('date') }}" readonly>
                                        {{-- @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" class="form-control @error('status') is-invalid @enderror"
                                            name="status">
                                            <option value="" selected disabled>Select status</option>
                                            <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>
                                                Present
                                            </option>
                                            <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent
                                            </option>
                                            <option value="late" {{ old('status') == 'late' ? 'selected' : '' }}>Late
                                            </option>
                                            <option value="early_leave"
                                                {{ old('status') == 'early_leave' ? 'selected' : '' }}>
                                                Early Leave</option>
                                        </select>
                                        {{-- @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror --}}
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
                    @else
                        <form class="form" action="{{ route('presences.store') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="latitude" class="form-label">Latitude</label>
                                        <input type="text" id="latitude"
                                            class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                                            required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="longitude" class="form-label">Longitude</label>
                                        <input type="text" id="longitude"
                                            class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                                            required readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="googlemaps">
                                        <iframe width="100%" height="450" style="border:0;" allowfullscreen=""
                                            loading="lazy"></iframe>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <b>Note</b>: Please allow location access to enable presence recording.
                                        <div id="locationError" style="color: red; display: none;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" id="btn-present" disabled>
                                        Submit
                                    </button>
                                    {{-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                        Reset
                                    </button> --}}
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </div>

    {{-- <script>
        const iframe = document.querySelector('iframe');

        const officeLat = -6.3223832;
        const officeLon = 106.7077614;
        const threshold = 0.01;

        let watchId = navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            iframe.src = `https://www.google.com/maps?q=${lat},${lon}&output=embed`;
        });

        document.addEventListener('DOMContentLoaded', (event) = {

            if (watchId) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    document.getElementId('latitude').value = lat;
                    document.getElementId('longitude').value = lon;

                    // compare lokasi sekarang dengan lokasi kantor
                    const distance = Math.sqrt(Math.pow(lat - officeLat, 2) + Math.pow(lon - officeLon, 2));

                    if (distance <= threshold) {
                        // posisi di sekitar kantor
                        alert('You are in the office, please record your presence!');
                        document.getElementById('btn-present').removeAttribute('disabled');
                    } else {
                        // posisi di jauh dri kantor
                        alert('You are not in the office, please go to the office for recording!');
                    }
                });
            }
        });
    </script> --}}

    <script>
        const iframe = document.querySelector('iframe');
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const btnPresent = document.getElementById('btn-present');
        const locationErrorDiv = document.getElementById('locationError');

        const officeLat = -6.345741616959628;
        const officeLon = 106.7143758907599;
        const threshold = 0.01;

        let watchId;
        let locationAcquired = false; // Tambahkan flag untuk status lokasi

        function updateMap(lat, lon) {
            if (iframe) {
                iframe.src = `https://www.google.com/maps?q=${lat},${lon}&output=embed`;
            }
        }

        function getLocation() {
            if (!locationAcquired) { // Periksa jika lokasi belum didapatkan
                if (navigator.geolocation) {
                    watchId = navigator.geolocation.watchPosition(showPosition, handleError, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    });
                } else {
                    handleError({
                        code: 'NOT_SUPPORTED'
                    });
                }
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            if (latitudeInput) latitudeInput.value = lat;
            if (longitudeInput) longitudeInput.value = lon;
            updateMap(lat, lon);

            const distance = Math.sqrt(Math.pow(lat - officeLat, 2) + Math.pow(lon - officeLon, 2));

            if (distance <= threshold) {
                if (btnPresent) btnPresent.removeAttribute('disabled');
                if (locationErrorDiv) locationErrorDiv.style.display = 'none';
            } else {
                if (btnPresent) btnPresent.setAttribute('disabled', 'disabled');
                if (locationErrorDiv) {
                    locationErrorDiv.textContent =
                        'You are outside the office. Please go to the office to record your presence.';
                    locationErrorDiv.style.display = 'block';
                }
            }
            locationAcquired = true; // Set flag setelah lokasi didapatkan
        }

        function handleError(error) {
            if (btnPresent) btnPresent.setAttribute('disabled', 'disabled');
            let errorMessage = "";

            switch (error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = "Location access denied. Please allow location access to use this feature.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage =
                        "Location information is not available. Make sure GPS or other location services are enabled.";
                    break;
                case error.TIMEOUT:
                    errorMessage = "The location request timed out. Please try again or check your internet connection.";
                    break;
                case error.UNKNOWN_ERROR:
                    errorMessage = "An unknown error occurred. Please try again.";
                    break;
                case 'NOT_SUPPORTED':
                    errorMessage = "Geolocation is not supported by this browser.";
                    break;
            }

            if (locationErrorDiv) {
                locationErrorDiv.textContent = errorMessage;
                locationErrorDiv.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (!latitudeInput.value || !longitudeInput.value) { // Cek jika field belum terisi
                getLocation();
            } else {
                locationAcquired = true; // Set flag jika sudah ada data
                if (btnPresent) btnPresent.removeAttribute('disabled'); // Enable tombol jika sudah ada data
            }
        });
    </script>
@endsection
