<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ /</span> Tài khoản</h4>

    <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <div class="content d-flex justify-content-end gap-2">
              <a href="{{ route('users.create') }}" class="btn btn-success">
                  <i class="fa fa-plus"></i> Thêm tài khoản
              </a>
            </div>
            <tr>
              <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
              <th>Tên tài khoản</th>
              <th>Email</th>
              <th>Phân quyền</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @if(isset($users) && is_object($users))
            @foreach($users as $users)
            <tr>
                <td><input type="checkbox" value="" id="checkAll" class="input-checkbox checked-item"></td>
                <td>
                  {{ $users -> name}}
                </td>
                <td>
                  {{ $users -> email}}
                </td>
                <td>
                  @if($users ->roles_id == 1) 
                    <span>Quản lí</span>
                  @else
                    <span>Khách hàng</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('users.edit', $users->id) }}" class="btn btn-success"><i class="bx bx-edit-alt me-1"></i></a>
                  <form method="POST" action="{{ route('users.delete', $users->id) }}" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">
                          <i class="bx bx-trash me-1"></i>
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
</div>