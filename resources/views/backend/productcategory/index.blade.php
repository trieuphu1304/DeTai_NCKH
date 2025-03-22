<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ /</span> Danh mục</h4>

    <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <div class="text-end">
                <a href="{{ route('productcategory.create')}}" class="btn btn-danger"><i class="fa fa-plus">Thêm danh mục</i></a>
            </div>
            <tr>
              <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
              <th>Tên danh mục</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @if(isset($productcategory) && is_object($productcategory))
            @foreach($productcategory as $productcategory)
            <tr>
                <td><input type="checkbox" value="" id="checkAll" class="input-checkbox checked-item"></td>
                <td>
                  {{ $productcategory -> name}}
                </td>
                
                <td>
                  <a href="{{ route('productcategory.edit', $productcategory->id)}}" class="btn btn-success"><i class="bx bx-edit-alt me-1"></i></a>
                  <form method="POST" action="{{ route('productcategory.delete', $productcategory->id)}}" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
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
