@extends('backend.layouts.main')

@section('title', 'Tạo mới sản phẩm')

@section('content')
    <h1>Tạo mới sản phẩm</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form name="product" action="{{ url("/backend/product/store") }}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="product_name">Tên sản phẩm:</label>
            <input type="text" name="product_name" class="form-control" id="product_name" value="{{ old('product_name', "") }}">
        </div>

        <div class="form-group">
            <label for="product_category">Danh mục sản phẩm:</label>
            <select name="category_id">
                <option>-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_status">Trạng thái sản phẩm:</label>
            <input type="radio" name="product_status" id="product_status" value="1"> Đang mở bán
            <input type="radio" name="product_status" id="product_status" value="2"> Tạm thời ngừng bán
        </div>

        <div class="form-group">
            <label for="product_image">Ảnh sản phẩm:</label>
            <input type="file" name="product_image" class="form-control" id="product_image">
        </div>
        <div class="form-group">
            <label for="product_image">Mô tả sản phẩm:</label>
            <textarea name="product_desc" class="form-control" rows="10" id="product_desc">{{ old('product_desc', "") }}</textarea>
        </div>
        <div class="form-group">
            <label for="product_publish">Thời gian mở bán sản phẩm:</label>
            <input type="text" name="product_publish" style="width: 250px" class="form-control" id="product_publish" value="{{ old('product_publish', "") }}">
        </div>
        <div class="form-group">
            <label for="product_quantity">Tồn kho sản phẩm:</label>
            <input type="number" name="product_quantity" style="width: 250px" class="form-control" id="product_quantity" value="{{ old('product_quantity', "") }}">
        </div>
        <div class="form-group">
            <label for="product_price">Giá sản phẩm:</label>
            <input type="text" name="product_price" style="width: 250px" class="form-control" id="product_price" value="{{ old('product_price', "") }}">
        </div>


        <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
    </form>
@endsection


@section('appendjs')
<link rel="stylesheet" href="{{ asset("/be-assets/js/bootstrap-datetimepicker.min.css") }}" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>

<script src="{{ asset("/be-assets/js/bootstrap-datetimepicker.min.js") }}"></script>

<script type="text/javascript">
    $(function () {
        $('#product_publish').datetimepicker({
            format:"YYYY-MM-DD HH:mm:ss",
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'far fa-times-circle'
            }
        });
    });
</script>

<script src="{{ asset("/be-assets/js/tinymce/tinymce.min.js") }}"></script>
<script>
    tinymce.init({
        selector: '#product_desc'
    });
</script>
@endsection
