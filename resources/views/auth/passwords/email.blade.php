<!doctype html>
<html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
        />

        <title>Reset Password</title>

        <meta name="description" content="" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
        />

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

        <!-- Core CSS -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/vendor/css/core.css') }}"
            class="template-customizer-core-css"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/vendor/css/theme-default.css') }}"
            class="template-customizer-theme-css"
        />
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

        <!-- Vendors CSS -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}"
        />

        <!-- Page CSS -->
        <!-- Page -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/vendor/css/pages/page-auth.css') }}"
        />
        <!-- Helpers -->
        <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('assets/js/config.js') }}"></script>
    </head>

    <body>
        <!-- Content -->

        <div class="container-xxl">
            <div
                class="authentication-wrapper authentication-basic container-p-y"
            >
                <div class="authentication-inner">
                    <!-- Register -->
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo -->
                            <div class="app-brand justify-content-center">
                               @include('admin_backoffice.icons.icon')
                               <span class="app-brand-text demo menu-text fw-bolder ms-2">Auth Core</span>
                            </div>
                            <!-- /Logo -->
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                                </div>
                            @endif   


                            <form
                                id="formAuthentication"
                                class="mb-3"
                                method="POST" action="{{ route('password.email') }}">
                                 @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label"
                                        >{{ __('Email Address') }}</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="email"
        
                                        placeholder="Enter your email"
                                        class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    />

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button
                                        class="btn btn-primary d-grid w-100"
                                        type="submit"
                                    >
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Register -->
                </div>
            </div>
        </div>

        <!-- / Content -->

        @include('auth.script')
    </body>
</html>
