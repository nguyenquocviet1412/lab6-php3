<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //Login
    public function getLogin(){
        return view('login');
    }
    public function postLogin(Request $request){
        $user = $request->only(['email','password']);

        //Xác thực thông tin của user
        if(Auth::attempt($user)){
                if(Auth::user()->active == 0){
                    return redirect()->back()->with('message', 'Tài khoản của bạn đã bị Khóa. Vui lòng liên hệ với quản trị để kích hoạt tài khoản.');
                }
                if(Auth::user()->active == 1){
                    $user = Auth::user();
                    return view('users.show',compact('user'));
                }

        }else{
            return redirect()->back()->with('message', 'Email hoặc Password không chính xác');
        }
    }

    public function getRegister(){
        return view('register');
    }
    public function postRegister(Request $request){
        $data = $request->validate([
            'username' => ['required','min:3','unique:users'],
            'fullname'=>['required','min:3'],
            'email' => ['required','email'],
            'password' => ['required','min:5'],
            'avatar' => ['nullable'],
            'confirm_password' =>['required','same:password'],
        ]);
        // dd($data);
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public'); // Lưu ảnh vào storage/app/public/avatars
        }
        //Đưa đường dẫn hình vào data
        $data['avatar']= $avatarPath;
        User::query()->create($data);

        return redirect()->route('login')->with('message', 'Đăng lý tài khoản thành công');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userEdit(User $user){
        return view('users.update', compact('user'));
    }

    public function userUpdate(Request $request, User $user){
        $data=$request->except('avatar');

        //Nếu cập nhật ảnh
        if($request->hasFile('avatar')){
            $path=$request->file('avatar')->store('avatars');
            $data['avatar']= $path;
            //Xóa ảnh cũ
            if($user->avatar !== null){
                Storage::delete($user->avatar);
            }

        }

        //Cập nhật dữ liệu
        $user->update($data);
        $user = Auth::user();

        return view('users.show',compact('user'))->with('message','Cập nhật dữ liệu thành công!');
    }
    public function userMatKhau(User $user){
        return view('users.password', compact('user'));
    }
    public function userMK(Request $request, User $user)
{
    // Validate the new password and confirmation
    $data = $request->validate([
        'passwordnew' => ['required'],
        'confirm_passwordnew' => ['required', 'same:passwordnew'],
        'password' => ['required'], // Mật khẩu hiện tại cần được cung cấp để xác thực
    ]);

    // Xác thực mật khẩu hiện tại
    if (Hash::check($data['password'], Auth::user()->password)) {
        // Kiểm tra xem mật khẩu mới có giống với mật khẩu hiện tại không
        if (Hash::check($data['passwordnew'], Auth::user()->password)) {
            return back()->with('error', 'Mật khẩu mới không được trùng với mật khẩu hiện tại.');
        }

        // Mã hóa mật khẩu mới và lưu lại
        $user->password = Hash::make($data['passwordnew']);
        $user->save();

        $user = Auth::user();
        return view('users.show', compact('user'))->with('message', 'Cập nhật mật khẩu thành công!');
    } else {
        return back()->with('message', 'Mật khẩu hiện tại không chính xác.');
    }
}


    public function listUsers(){
        $users = User::all();
        return view('admin.list', compact('users'));
    }

    public function toggleStatus(Request $request, User $user)
{
    // Cập nhật trạng thái của người dùng
    $user->active = $request->active;
    $user->save();

    return redirect()->back()->with('message', 'Trạng thái người dùng đã được cập nhật!');
}
}
