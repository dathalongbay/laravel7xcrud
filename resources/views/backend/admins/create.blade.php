@extends('backend.layouts.main')

@section('title', 'Tạo mới admin')

@section('content')
    <h1>Tạo mới admin</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form name="category" action="{{ url("/backend/admins/store") }}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', "") }}">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', "") }}">
        </div>

        <div class="form-group">
            <label for="image">Ảnh đại diện:</label>
            <input type="file" name="avatar" class="form-control" id="image">
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="text" name="password" class="form-control" id="password" value="{{ old('password', "") }}">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Nhập lại mật khẩu:</label>
            <input type="text" name="password_confirmation" class="form-control" id="password_confirmation" value="{{ old('password_confirmation ', "") }}">
        </div>

        <div class="form-group">
            <label for="desc">Ghi chú:</label>
            <textarea name="desc" class="form-control" rows="5" id="desc">{{ old('desc', "") }}</textarea>
        </div>


        <button type="submit" class="btn btn-info">Thêm admin</button>
    </form>

@endsection

