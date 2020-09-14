<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //
    //

    public function index(Request $request) {

        $sort = $request->query('sort', "");
        $searchKeyword = $request->query('name', "");

        $queryORM = CategoryModel::where('name', "LIKE", "%".$searchKeyword."%");

        if ($sort == "name_asc") {
            $queryORM->orderBy('name', 'asc');
        }
        if ($sort == "name_desc") {
            $queryORM->orderBy('name', 'desc');
        }

        $categories = $queryORM->paginate(10);

        // truyền dữ liệu xuống view
        $data = [];
        $data["categories"] = $categories;

        // truyền keyword search xuống view
        $data["searchKeyword"] = $searchKeyword;
        $data["sort"] = $sort;

        return view("backend.category.index", $data);
    }


    public function create() {

        return view("backend.category.create");
    }

    public function edit($id) {

        $category = CategoryModel::findOrFail($id);

        // truyền dữ liệu xuống view
        $data = [];
        $data["category"] = $category;

        return view("backend.category.edit", $data);
    }

    public function delete($id) {

        $category = CategoryModel::findOrFail($id);

        // truyền dữ liệu xuống view
        $data = [];
        $data["category"] = $category;

        return view("backend.category.delete", $data);
    }

    public function store(Request $request) {

        // validate dữ liệu
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'desc' => 'required',
        ]);

        $name = $request->input('name', '');
        $slug = $request->input('slug', '');
        $desc = $request->input('desc', '');

        $pathCategoryImage = $request->file('image')->store('public/categoryimages');

        $category = new CategoryModel();

        $category->name = $name;
        $category->slug = $slug;
        $category->desc = $desc;

        $category->image = $pathCategoryImage;

        // lưu danh mục
        $category->save();

        return redirect("/backend/category/index")->with('status', 'thêm danh mục thành công !');
    }

    // phương thức sẽ nhập data post đi và cập
    // nhật vào trong CSDL
    public function update(Request $request, $id) {

        // validate dữ liệu
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'desc' => 'required',
        ]);

        $name = $request->input('name', '');
        $slug = $request->input('slug', '');
        $desc = $request->input('desc', '');

        // lấy đối tượng model dựa trên biến $id
        $category = CategoryModel::findOrFail($id);

        $category->name = $name;
        $category->slug = $slug;
        $category->desc = $desc;

        // upload ảnh
        if ($request->hasFile('image')){

            if ($category->image) {
                Storage::delete($category->image);
            }

            $pathCategoryImage = $request->file('image')->store('public/categoryimages');
            $category->image = $pathCategoryImage;
        }

        // lưu danh mục
        $category->save();

        // chuyển hướng về trang /backend/category/edit/id
        return redirect("/backend/category/edit/$id")->with('status', 'cập nhật danh mục thành công !');

    }


    // xóa danh mục thật sự trong CSDL
    public function destroy($id) {

        $countProducts = DB::table('products')->count();

        if ($countProducts > 0) {

            return redirect("/backend/category/index")->with('status', 'xóa tất cả các sản phẩm thuộc danh mục này trước khi xóa danh mục !');
        }

        // lấy đối tượng model dựa trên biến $id
        $category = CategoryModel::findOrFail($id);
        $category->delete();

        // chuyển hướng về trang /backend/category/index
        return redirect("/backend/category/index")->with('status', 'xóa danh mục thành công !');
    }
}
