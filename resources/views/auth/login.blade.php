@extends('auth.layouts.main2')
@section('content2')
    <div class="nav-header bg-transparent shadow-none border-0">
        <div class="nav-top w-100 d-flex justify-content-between align-items-center">
            <!-- Grup Kiri -->
            <div class="d-flex align-items-center">
                <img src="{{ asset('StarMar/StarMar-.png') }}" width="100" alt="">
                <a href="index.html"><i class=""></i>
                    <span
                        class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">StarMar.</span>
                </a>
            </div>
            {{-- <div>
                <a href="{{ route('register') }}"
                    class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl">Register</a>
            </div> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat"
            style="background-image: url('{{ asset('dist2/images/login-bg.jpg') }}');"></div>
        <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
            <div class="card shadow-none border-0 ms-auto me-auto login-card">
                <div class="card-body rounded-0 text-left">
                    <h2 class="fw-700 display1-size display2-md-size mb-3">Login into <br>your account</h2>
                    <div class="form-container">
                        <form action="{{ route('login') }}" method="POST" autocapitalize="off" autocomplete="on">
                            @csrf
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                <input type="text" name="email"
                                    class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                    placeholder="Your Email Address">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group icon-input mb-1">
                                <input type="Password" name="password"
                                    class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                    placeholder="Password">
                                <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-check text-left mb-3">
                                <input type="checkbox" class="form-check-input mt-2" id="exampleCheck5" required>
                                <label class="form-check-label font-xsss text-grey-500" for="exampleCheck5">Remember
                                    me</label>
                                <a href="{{ route('password.request') }}"
                                    class="fw-600 font-xsss text-grey-700 mt-1 float-right">Forgot
                                    your Password?</a>
                            </div>

                            <div class="col-sm-12 p-0 text-left">
                                <button type="submit"
                                    class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0"
                                    id="submit-button">
                                    <span id="submit-text">Login</span>
                                    <span id="loading-spinner" class="spinner-border spinner-border-sm d-none"
                                        role="status" aria-hidden="true"></span>
                                </button>
                                <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Dont have account <a
                                        href="{{ route('register') }}" class="fw-700 ms-1">Register</a></h6>
                            </div>
                        </form>
                    </div>


                    <div class="col-sm-12 p-0 text-center mt-2">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .style2-input {
            transition: all 0.3s ease-in-out;
        }

        .style2-input:focus {
            transform: scale(1.05);
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .form-container {
            animation: fadeIn 1s ease-in-out;
        }

        button[type="submit"] {
            transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .text-danger {
            animation: slideDown 0.3s ease-in-out;
        }

        .form-check-input {
            transition: all 0.3s ease-in-out;
        }

        .form-check-input:checked {
            transform: scale(1.2);
            border-color: #007bff;
        }

        a {
            transition: color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        a:hover {
            color: #0056b3;
            transform: translateX(5px);
        }

        .icon-input i {
            transition: transform 0.3s ease-in-out;
        }

        .icon-input input:focus+i {
            transform: scale(1.2);
            color: #007bff;
        }

        .spinner-border {
            vertical-align: middle;
            margin-left: 10px;
        }
    </style>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.submit();
            }, 300);
        });
        document.querySelector('form').addEventListener('submit', function(event) {
            const submitButton = document.getElementById('submit-button');
            const submitText = document.getElementById('submit-text');
            const loadingSpinner = document.getElementById('loading-spinner');

            submitText.textContent = 'Logging in...';
            loadingSpinner.classList.remove('d-none');
            submitButton.disabled = true;
        });
    </script>
@endsection
