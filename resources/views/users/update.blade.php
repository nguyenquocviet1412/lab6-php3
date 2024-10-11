<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cập Nhật Thông Tin Cá Nhân</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container mt-5">
        <h2 class="text-center mb-4">Cập Nhật Thông Tin Cá Nhân</h2>
        @if(session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fullname">Họ và tên</label>
                <input type="text" class="form-control" name="fullname" value="{{$user->fullname}}" placeholder="Nhập họ và tên" required>
            </div>
            @error('fullname')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="Nhập tên đăng nhập" required>
            </div>
            @error('username')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Nhập địa chỉ email" required>
            </div>
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" class="form-control-file" name="avatar" id="avatar" accept="image/*" onchange="previewAvatar(event)">
                <img id="avatarPreview" class="avatar-preview" src="{{asset('storage'). '/'. $user->avatar}}" alt="Avatar Preview" >
            </div>
            @error('file')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <button type="submit" class="btn btn-primary btn-block">Cập Nhật</button>
        </form>
    </div>

    <script>
        function previewAvatar(event) {
            const avatarPreview = document.getElementById('avatarPreview');
            avatarPreview.style.display = 'block';
            avatarPreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
