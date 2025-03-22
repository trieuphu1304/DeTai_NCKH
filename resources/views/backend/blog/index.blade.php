<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ /</span> Blog</h4>

  <div class="table-responsive text-nowrap">
      <table class="table">
          <thead>
                <div class="content d-flex justify-content-end gap-2">
                  <a href="{{ route('blog.create') }}" class="btn btn-success">
                      <i class="fa fa-plus"></i> Thêm blog
                  </a>
                </div>
              <tr>
                  <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
                  <th>Tên blog</th>
                  <th>Description</th>
                  <th>Image</th>
              </tr>
          </thead>
          <tbody class="table-border-bottom-0">
              @if(isset($blog) && is_object($blog))
              @foreach($blog as $item)
              <tr>
                  <td><input type="checkbox" value="{{ $item->id }}" class="input-checkbox checked-item"></td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->description }}</td>
                  <td>
                      @if ($item->image)
                      <img src="{{ asset('upload/blog/' . $item->image) }}" alt="Image" style="width: 100px;">
                      @endif
                  </td>
                  <td>
                      <a href="{{ route('blog.edit', $item->id) }}" class="btn btn-success"><i class="bx bx-edit-alt me-1"></i></a>
                      <form method="POST" action="{{ route('blog.delete', $item->id) }}" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa blog này?')">
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
