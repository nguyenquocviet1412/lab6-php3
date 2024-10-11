<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">User Information</h4>
                    </div>
                    @if(session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card-body">
                        @section('message')
                            <div class="alert text-danger">{{session('message')}}</div>
                        @endsection
                        <div class="mb-3 text-center">
                            <img src="{{asset('storage'). '/'. $user->avatar}}" alt="Avatar" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px;">
                        </div>
                        <form>
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" placeholder="{{$user->fullname}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="{{$user->username}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="{{$user->email}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="********"  readonly>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" placeholder="{{$user->role}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="active" class="form-label">Status</label>
                                <input type="text" class="form-control" id="active" placeholder="

                                @if ($user->active == 1)
                                    kích hoạt
                                @elseif ($user->active == 0)
                                    ngưng hoạt động
                                @endif

                                " readonly>
                            </div>
                            <div class="text-center">
                                <input type="hidden" value="{{$user->id}}">
                                <a href="{{route('user.update',$user->id)}}" class="btn btn-warning">Cập nhật thông tin</a>
                                <a href="{{route('user.matkhau',$user->id)}}" class="btn btn-danger" >Đổi mật khẩu</a>
                                @if ($user->role == 'admin')
                                <a href="{{route('admin.list',$user->id)}}" class="btn btn-danger" >Danh sách tài khoản</a>
                                @endif

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
