<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    //

    public function loginview() {

        //dd(session()->all()); die;
        $session_admin_login = session('admin_login', false);

        var_dump($session_admin_login);

        if ($session_admin_login && isset($session_admin_login["id"]) && ($session_admin_login["id"] > 0)) {
            return redirect('/backend');
        }

        return view("backend.login.login");
    }

    public function loginPost(Request $request) {

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        // validate dữ liệu
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->input('email', '');
        $password = $request->input('password', '');
        $remember_me = $request->input('remember_me', '');

        $admin = DB::table('admins')
            ->where('email', '=', $email)
            ->first();

        if (!$admin) {
            $request->session()->flash('status', 'thông tin đăng nhập không đúng !!');

            return view("backend.login.login");
        }

        echo "<pre>";
        print_r($admin);
        echo "</pre>";
        var_dump(Hash::check($password, $admin->password));


        if (isset($admin->id) && ($admin->id > 0) && Hash::check($password, $admin->password)) {
            $adminLogin = [
                "id" => $admin->id,
                "email" => $admin->email,
                "name" => $admin->name,
                "password" => $admin->password,
                "avatar" => $admin->avatar,
                ];

            session(['admin_login' => $adminLogin]);

            // tạo cookie remember Me và cập nhật vào trong bản ghi của CSDL
            if ($remember_me == "on") {
                $minutes = 3600*30;
                $hash = $admin->id.$admin->email.$admin->password;
                $cookieValue = Hash::make($hash);
                cookie('admin_login_remember', $cookieValue, $minutes);
                // update vào CSDL
                DB::table('admins')
                    ->where('id', $admin->id)
                    ->update(['remember_token' => $cookieValue]);
            }


            return redirect('/backend');
        }

        $request->session()->flash('status', 'thông tin đăng nhập không đúng !!');

        return view("backend.login.login");
    }


    public function logout(Request $request) {
        cookie('admin_login_remember', "", -3600);

        $request->session()->forget(['admin_login']);

        $request->session()->flush();

        return redirect('/backend/admin-login');
    }
}
