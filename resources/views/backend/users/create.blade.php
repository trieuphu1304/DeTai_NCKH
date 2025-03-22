<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ/</span> Thêm tài khoản</h4>
    
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thêm tài khoản<h5>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Tên</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Tên" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Mật khẩu" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="roles_id">Vai trò</label>
                            <select name="roles_id" class="form-select" id="roles_id">
                                <option value="1" {{ old('roles_id') == 1 ? 'selected' : '' }}>Quản lý</option>
                                <option value="0" {{ old('roles_id') == 0 ? 'selected' : '' }}>Khách hàng</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
                    </form>
                    
                  </div>
                </div>
              </div>
        </div>
    </div>     
</div>   