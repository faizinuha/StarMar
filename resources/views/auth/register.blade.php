@extends('auth.layouts.main')
@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed"
        data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="index-2.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            <img src="{{asset('StarMar/StarMar-.png')}}"
                                width="50" style="border-radius: 50px" alt="">
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center"
                            style="height: calc(100vh - 100px);">
                            <img src="{{asset('StarMar/StarMar-.png')}}"
                                alt="" class="img-fluid" width="400">
                        </div>
                    </div>
                <div class="col-xl-5 mt-3  col-xxl-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body wizard-content">
                                    <h4 class="card-title">Welcome to StarMar</h4>
                                    <p class="card-subtitle mb-3"> Please Register to Continue </p>
                                    <form action="{{ route('register') }}" class="validation-wizard wizard-circle mt-5"
                                        method="POST">
                                        @csrf
                                        <!-- Step 1 -->
                                        <h6>Step 1</h6>
                                        <section>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="first_name"> First Name : <span class="danger">*</span>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('first_name') is-invalid @enderror"
                                                            id="first_name" name="first_name"
                                                            value="{{ old('first_name') }}" />
                                                        @error('first_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="last_name"> Last Name : <span class="danger">*</span>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control  @error('last_name') is-invalid @enderror"
                                                            id="last_name" name="last_name"
                                                            value="{{ old('last_name') }}" />
                                                        @error('last_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="email"> Email Address : <span class="danger">*</span>
                                                        </label>
                                                        <input type="email"
                                                            class="form-control  @error('email') is-invalid @enderror"
                                                            id="email" name="email" value="{{ old('email') }}" />
                                                        @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone">Phone Number :</label>
                                                        <input type="tel"
                                                            class="form-control  @error('phone') is-invalid @enderror"
                                                            id="phone" name="phone" value="{{ old('phone') }}" />
                                                        @error('phone')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="gender"> Gender : <span class="danger">*</span>
                                                        </label>
                                                        <select class="form-select  @error('gender') is-invalid @enderror"
                                                            id="gender" name="gender">
                                                            <option value="">SELECT GENDER</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            <option value="custom">Custom</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="date">Date of Birth :<span
                                                                class="danger">*</span></label>
                                                        <input type="date"
                                                            class="form-control  @error('date') is-invalid @enderror"
                                                            id="date" name="date" value="{{ old('date') }}" />
                                                        @error('date')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- Step 2 -->
                                        <h6>Step 2</h6>
                                        <section>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="password">Password :<span class="danger">*</span></label>
                                                        <input type="password" autocomplete="true"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="password" name="password"
                                                            value="{{ old('password') }}" oninput="checkPasswordStrength()" />
                                                        @error('password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                        <!-- Strength Meter -->
                                                        <div id="password-strength" class="mt-2">
                                                            <small class="text-muted" id="strength-text"></small>
                                                            <div class="progress">
                                                                <div class="progress-bar" id="strength-bar" role="progressbar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <script>
                                                    function checkPasswordStrength() {
                                                        const password = document.getElementById("password").value;
                                                        const strengthBar = document.getElementById("strength-bar");
                                                        const strengthText = document.getElementById("strength-text");
                                                
                                                        let strength = 0;
                                                
                                                        // Check password criteria
                                                        if (password.length >= 8) strength++; // Minimum 8 characters
                                                        if (/[A-Z]/.test(password)) strength++; // Contains uppercase
                                                        if (/[a-z]/.test(password)) strength++; // Contains lowercase
                                                        if (/[0-9]/.test(password)) strength++; // Contains numbers
                                                        if (/[@$!%*?&]/.test(password)) strength++; // Contains special characters
                                                
                                                        // Update progress bar and text based on strength
                                                        const strengthLabels = ["Weak", "Fair", "Good", "Strong", "Very Strong"];
                                                        const strengthColors = ["#dc3545", "#ffc107", "#17a2b8", "#28a745", "#007bff"];
                                                
                                                        // Calculate strength percentage
                                                        const strengthPercentage = (strength / 5) * 100;
                                                
                                                        strengthBar.style.width = strengthPercentage + "%";
                                                        strengthBar.style.backgroundColor = strengthColors[strength - 1] || "#dc3545";
                                                        strengthText.textContent = strengthLabels[strength - 1] || "Too Weak";
                                                
                                                        // Reset if no password
                                                        if (!password) {
                                                            strengthBar.style.width = "0%";
                                                            strengthText.textContent = "";
                                                        }
                                                    }
                                                </script>                                                
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="password_confirmation">Confirm Password :<span
                                                                class="danger">*</span></label>
                                                        <input type="password"
                                                            class="form-control  @error('password') is-invalid @enderror"
                                                            id="password_confirmation" name="password_confirmation" />
                                                        @error('password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    {!! htmlFormSnippet() !!}
                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <div>
                                                            <small class="text-danger">
                                                                {{ $errors->first('g-recaptcha-response') }}
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </section>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
@endsection
