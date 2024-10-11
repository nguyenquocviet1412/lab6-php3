<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Danh sách người dùng</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh Sách Người Dùng</h2>
        <div class="mb-3">
            <input type="text" class="form-control" id="search" placeholder="Tìm kiếm người dùng...">
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Họ và tên</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Avatar</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>********</td>
                    <td><img src="{{asset('storage'). '/'. $user->avatar}}" alt="Avatar" class="avatar"></td>
                    <td>{{$user->role}}</td>
                    <td>
                        <form action="{{ route('admin.toggleStatus', $user->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="active" value="{{ $user->active ? 0 : 1 }}">
                            <input type="checkbox" class="toggle-status" {{ $user->active ? 'checked' : '' }} data-toggle="toggle" data-on="Hoạt động" data-off="Chưa kích hoạt" data-onstyle="success" data-offstyle="danger" onchange="this.form.submit()">
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <script>
        $(function() {
    $('.toggle-status').bootstrapToggle();
});
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</body>
</html>
