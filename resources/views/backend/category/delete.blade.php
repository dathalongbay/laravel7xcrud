@extends('backend.layouts.main')

@section('title', 'Xóa danh mục')

@section('content')
    <h1>Xóa danh mục</h1>

    <form name="product" action="{{ url("/backend/category/destroy/$category->id") }}" method="post">

        @csrf

        <div class="form-group">
            <label for="product_name">ID danh mục:</label>
            <p>{{ $category->id }}</p>
        </div>

        <div class="form-group">
            <label for="product_name">Tên danh mục:</label>
            <p>{{ $category->name }}</p>
        </div>

        <button type="submit" class="btn btn-danger">Xác nhận xóa danh mục</button>
    </form>
@endsection
