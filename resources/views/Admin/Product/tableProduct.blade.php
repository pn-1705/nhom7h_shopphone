<table class="table table table-striped" >
    <thead class="card-header" style="background: #00bb00; margin-top: 20px">
    <tr class="">
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tên</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Đơn giá</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Số lượng trong kho</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Danh mục</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Nhà cung cấp</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">#</th>
    </tr>
    </thead>
    <tbody>
    @foreach($menus as $item)
        <tr>
            <td>{{ $item->TenSP }}</td>
            <td>{{ $item->DonGia}}</td>
            <td>{{ $item->SoLuong}}</td>
            <td>{{$item->DM_id}} - {{ $item->TenDM }}</td>
            <td>{{$item->TH_id}} - {{ $item->TenLSP }}</td>
            <td>
                <a class="btn btn-warning" href="/admin/product/edt?id={{$item->id}}"><span class="material-symbols-outlined">
                            edit
                        </span></a>
                <a class="btn btn-danger" href="/admin/edt/destroy?id={{$item->id}}"><span class="material-symbols-outlined">
                        delete
                        </span>
                </a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
