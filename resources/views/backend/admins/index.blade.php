@extends('backend.layouts.main')

@section('title', 'Liệt kê admin')

@section('content')
    <h1>Liệt kê admin</h1>

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

    <div style="padding: 10px; border: 1px solid #4e73df; margin-bottom: 10px">
        <form name="search_admin" method="get" action="{{ htmlspecialchars($_SERVER["REQUEST_URI"]) }}" class="form-inline">

            <input name="name" value="{{ $searchKeyword }}" class="form-control" style="width: 350px; margin-right: 20px" placeholder="Nhập tên quản trị viên bạn muốn tìm kiếm ..." autocomplete="off">


            <select name="sort" class="form-control" style="width: 150px; margin-right: 20px">
                <option value="">Sắp xếp</option>
                <option value="name_asc" {{ $sort == "name_asc" ? " selected" : "" }}>Tên tăng dần</option>
                <option value="name_desc" {{ $sort == "name_desc" ? " selected" : "" }}>Tên giảm dần</option>
            </select>

            <div style="padding: 10px 0">
                <input type="submit" name="search" class="btn btn-success" value="Lọc kết quả">
            </div>

            <div style="padding: 10px 0">
                <a href="#" id="clear-search" class="btn btn-warning">Clear filter</a>
            </div>

            <input type="hidden" name="page" value="1">

        </form>
    </div>

    {{ $admins->links() }}

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div style="padding: 20px">
        <a href="{{ url("/backend/admins/create") }}" class="btn btn-info">Thêm quản trị viên</a>
    </div>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Id</th>
            <th>ảnh đại diện</th>
            <th>tên</th>
            <th>email</th>
            <th>hành động</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>ảnh đại diện</th>
            <th>tên</th>
            <th>email</th>
            <th>hành động</th>
        </tr>
        </tfoot>
        <tbody>

        @if(isset($admins) && !empty($admins))
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>
                        @if ($admin->avatar)
                            <?php
                            $admin->avatar = str_replace("public/", "", $admin->avatar);
                            ?>

                            <div>
                                <img src="{{ asset("storage/$admin->avatar") }}" style="width: 200px; height: auto" />
                            </div>

                        @endif
                    </td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>

                    <td>
                        <a href="{{ url("/backend/admins/edit/$admin->id") }}" class="btn btn-warning">Sửa quản trị viên</a>
                        <a href="{{ url("/backend/admins/delete/$admin->id") }}" class="btn btn-danger">Xóa quản trị viên</a>
                    </td>
                </tr>
            @endforeach
        @else
            Chưa có bản ghi nào trong bảng này
        @endif

        </tbody>
    </table>

    {{ $admins->links() }}

@endsection

@section('appendjs')

    <script type="text/javascript">

        $(document).ready(function () {
            $("#clear-search").on("click", function (e) {
                e.preventDefault();

                $("input[name='name']").val('');
                $("select[name='sort']").val('');

                $("form[name='search_admin']").trigger("submit");
            });

            $("a.page-link").on("click", function (e) {
                e.preventDefault();

                var rel = $(this).attr("rel");

                if (rel == "next") {
                    var page = $("body").find(".page-item.active > .page-link").eq(0).text();
                    console.log(" : " + page);
                    page = parseInt(page);
                    page += 1;
                } else if(rel == "prev") {
                    var page = $("body").find(".page-item.active > .page-link").eq(0).text();
                    console.log(page);
                    page = parseInt(page);
                    page -= 1;
                } else {
                    var page = $(this).text();
                }

                console.log(page);

                page = parseInt(page);

                $("input[name='page']").val(page);

                $("form[name='search_admin']").trigger("submit");
            });
        });
    </script>

@endsection

