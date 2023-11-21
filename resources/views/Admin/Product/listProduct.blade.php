@extends('Admin.main')
@section('content')
    <a href="/admin/product/add" class="btn btn-primary float-right"  style="margin-top: 20px;width: 200px"><i class="fas fa-plus"></i> Thêm sản phẩm</a>
    <div id="table-data">
        <table class="table table table-striped" >
            <thead class="card-header" style="background: #00bb00; margin-top: 20px">
            <tr class="">
                <th id="id" class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" >ID</th>
                <th id="TenSP" class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tên</th>
                <th id="DonGia" class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Đơn giá</th>
                <th id="SoLuong" class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Số lượng trong kho</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">
                    <select style="border: none; font-weight: bold;background-color: transparent" id="selectIDDM" name="idLoaiHoGD" onchange="filterData()">
                        <option value="-1">Danh mục</option>
                        @foreach ($danhmuc as $loai)
                            @if($loai->id==$idDM)
                                <option selected="true" value="{{ $loai->id }}">{{$loai->TenDM}}</option>
                            @else
                                <option value="{{ $loai->id }}">{{$loai->TenDM}}</option>
                            @endif
                        @endforeach
                    </select></th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">
                    <select style="border: none; font-weight: bold;background-color: transparent" id="selectedIDXa" name="idXa" onchange="filterData()">
                        <option value="-1">Nhà cung cấp</option>
                        @foreach ($loais as $id)
                            @if ($id->id==$idNCC)
                                <option selected="true" value="{{ $id->id }}">{{$id->TenLSP}}</option>
                            @else
                                <option value="{{ $id->id }}">{{$id->TenLSP}}</option>
                            @endif
                        @endforeach
                    </select>
                </th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->TenSP }}</td>
                    <td>{{ number_format($item->DonGia, 0, ',', '.') }} VNĐ</td>
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
    </div>
    <div class="card-tools float-right">
        <ul class="pagination pagination-sm">
            @if ($menus->onFirstPage())
                <li class="disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item" ><a class="page-link" href="{{ $menus->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif
            @if ($menus->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $menus->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function filterData() {
        var idDanhMuc = document.getElementById("selectIDDM").value;
        var idXa = document.getElementById("selectedIDXa").value;
        var url = "/admin/product?idDM=" + idDanhMuc+"&idNCC="+idXa;
        history.pushState({ path: url }, '', url);
        $.ajax({
            url: url,
            type: "GET",
            dataType: "html",
            success: function(data) {
                document.open();
                document.write(data);
                document.close();
            },
            error: function() {
                alert("Lỗi khi tải dữ liệu.");
            }
        });
    }
</script>
