<?php
use Carbon\Carbon;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
  @if (Auth::check())
        {{ Auth::user()->name }} <a href="{{ route('logout') }}">Logout</a>
    @else
        <p>Bạn chưa đăng nhập</p>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Vị trí</th>
            <th>Thời gian bắt đầu</th>
            <th>Thời gian kết thúc</th>
            <th><a href="{{ route('shift_user.create') }}" class="btn btn-primary">Thêm</a></th>
          </tr>
        </thead>
        <tbody>

        @foreach ($ca_da_dang_ky as $cdk)                
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $cdk->user->name }}</td>
            <td>{{ $cdk->shift->position }}</td>
            <td>{{ $cdk->shift->start_time }}</td>
            <td>{{ $cdk->shift->end_time }}</td>

            <td>
                <a href="{{ route('shift_user.edit', ['id' => $cdk->id]) }}" class="btn btn-warning">Sửa</a>
                <a href="{{ route('shift_user.delete', ['id' => $cdk->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Xóa</a>
            </td>
          </tr>
        @endforeach

        </tbody>
      </table>

</body>
</html>