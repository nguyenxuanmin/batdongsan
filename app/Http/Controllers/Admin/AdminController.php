<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        if (empty($email) || empty($password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email và mật khẩu không được để trống.',
            ]);
        }

        $credentials = ['email' => $email, 'password' => $password];
        if (auth()->attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Bạn đăng nhập thành công.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin đăng nhập không chính xác.',
            ]);
        }
    }

    public function signup(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        
        if (empty($name) || empty($email) || empty($password)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên, email và mật khẩu không được để trống.',
            ]);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'success' => false,
                'message' => $email. ' không phải là email hợp lệ.',
            ]);
        }
        if (strlen($password) < 6) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            ]);
        }
        $user = User::where('email','=',$email)->first();
        if (isset($user)) {
            return response()->json([
                'success' => false,
                'message' => 'Email đã tồn tại.',
            ]);
        }
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        $credentials = ['email' => $email, 'password' => $password];
        if (auth()->attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Đăng ký thành công.',
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
