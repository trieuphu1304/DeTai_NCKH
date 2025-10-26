<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('backend/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Đăng nhập</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/pages/page-auth.css') }}" />
    <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('backend/assets/js/config.js') }}"></script>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner" style="max-width: 100% !important;">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <!-- SVG giữ nguyên -->
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">Quản lí</span>
                            </a>
                        </div>
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row justify-content-center">
                                <div class="col-md-6">

                                    <!-- Thông tin cá nhân -->
                                    <div class="card shadow rounded mb-4">
                                        <h5 class="card-header bg-primary text-white">
                                            <i class="bx bx-user me-1"></i> Cập nhật thông tin cá nhân
                                        </h5>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('settings.update') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Tên</label>
                                                    <input type="text" id="name" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $user->name) }}" required autofocus>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email', $user->email) }}" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                                                    <input type="file" id="avatar" name="avatar"
                                                        class="form-control @error('avatar') is-invalid @enderror">
                                                    @error('avatar')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                    @if ($user->avatar)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                                                alt="Avatar" width="80" class="rounded-circle">
                                                        </div>
                                                    @endif
                                                </div>

                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="bx bx-save"></i> Lưu thay đổi
                                                </button>
                                            </form>

                                        </div>
                                    </div>

                                    <!-- Đổi mật khẩu -->
                                    <div class="card shadow rounded">
                                        <h5 class="card-header bg-warning text-white">
                                            <i class="bx bx-lock-alt me-1"></i> Đổi mật khẩu
                                        </h5>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('settings.password.update') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="current_password" class="form-label">Mật khẩu hiện
                                                        tại</label>
                                                    <input type="password" id="current_password"
                                                        name="current_password"
                                                        class="form-control @error('current_password') is-invalid @enderror"
                                                        required>
                                                    @error('current_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Mật khẩu mới</label>
                                                    <input type="password" id="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        required>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="form-label">Xác nhận mật
                                                        khẩu</label>
                                                    <input type="password" id="password_confirmation"
                                                        name="password_confirmation" class="form-control" required>
                                                </div>

                                                <button type="submit" class="btn btn-warning w-100 text-white">
                                                    <i class="bx bx-key"></i> Đổi mật khẩu
                                                </button>
                                                <a href="{{ route('dashboard.layout') }}"
                                                    class="btn btn-secondary w-100 mt-2"> Quay lại</a>

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

    <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: "{{ session('success') }}",
            });
        </script>
    @endif
</body>

</html>
