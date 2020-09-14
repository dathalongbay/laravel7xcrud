@extends('backend.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1>Danh sách sản phẩm</h1>

    <div style="padding: 10px; border: 1px solid #4e73df">
        <form name="search_product" method="post" action="" class="form-inline">
            @csrf
            http_build_query()

            <input name="product_name" value="" class="form-control" style="width: 350px; margin-right: 20px" placeholder="Nhập tên sản phẩm bạn muốn tìm kiếm ..." autocomplete="off">

            <select name="product_status" class="form-control" style="width: 150px; margin-right: 20px">
                <option value="">Lọc theo trạng thái</option>
                <option value="1">Đang mở bán</option>
                <option value="0">Ngừng bán</option>
            </select>


            <select name="product_sort" class="form-control" style="width: 150px; margin-right: 20px">
                <option value="1">Sắp xếp</option>
                <option value="1">Giá tăng dần</option>
                <option value="0">Giá giảm dần</option>
                <option value="0">Tồn kho tăng dần</option>
                <option value="0">Tồn kho giảm dần</option>
            </select>

        </form>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div style="padding: 20px">
        <a href="{{ url("/backend/product/create") }}" class="btn btn-info">Thêm sản phẩm</a>
    </div>



    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Id sản phẩm</th>
            <th>ảnh đại diện</th>
            <th>tên sản phẩm</th>
            <th>giá sản phẩm</th>
            <th>tồn kho</th>
            <th>hành động</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id sản phẩm</th>
            <th>ảnh đại diện</th>
            <th>tên sản phẩm</th>
            <th>giá sản phẩm</th>
            <th>tồn kho</th>
            <th>hành động</th>
        </tr>
        </tfoot>
        <tbody>

            @if(isset($products) && !empty($products))
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if ($product->product_image)
                            <?php
                            $product->product_image = str_replace("public/", "", $product->product_image);
                            ?>

                            <div>
                                <img src="{{ asset("storage/$product->product_image") }}" style="width: 200px; height: auto" />
                            </div>

                            @endif
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_price }} USD</td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>
                            <a href="{{ url("/backend/product/edit/$product->id") }}" class="btn btn-warning">Sửa sản phẩm</a>
                            <a href="{{ url("/backend/product/delete/$product->id") }}" class="btn btn-danger">Xóa sản phẩm</a>
                        </td>
                    </tr>
                @endforeach
            @else
                Chưa có bản ghi nào trong bảng này
            @endif

        </tbody>
    </table>

    {{ $products->links() }}
@endsection
