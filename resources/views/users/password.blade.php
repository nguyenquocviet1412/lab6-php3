<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Đổi Mật Khẩu</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="form-container mt-5">
        <h2 class="text-center mb-4">Đổi Mật Khẩu</h2>
        @if(session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{route('user.MK',$user->id)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="oldPassword">Mật khẩu cũ</label>
                <input type="password" name="password" class="form-control"  placeholder="Nhập mật khẩu cũ" >
            </div>
            @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="form-group">
                <label for="newPassword">Mật khẩu mới</label>
                <input type="password" name="passwordnew" class="form-control"  placeholder="Nhập mật khẩu mới" >
            </div>
            @error('passwordnew')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="form-group">
                <label for="confirmPassword">Xác nhận mật khẩu mới</label>
                <input type="password" name="confirm_passwordnew" class="form-control" placeholder="Xác nhận mật khẩu mới" >
            </div>
            @error('confirm_passwordnew')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <button type="submit" class="btn btn-primary btn-block">Đổi Mật Khẩu</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
