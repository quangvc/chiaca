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

    <table class="table">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Thời gian bắt đầu</th>
            <th>Thời gian kết thúc</th>
            <th>Vị trí</th>
            <th><a href="{{ route('shift.create') }}" class="btn btn-primary">Thêm</a></th>
          </tr>
        </thead>
        <tbody>

        @foreach ($shifts as $shift)                
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>Ca từ {{ Carbon::parse($shift->start_time)->format('H:i') }} đến {{ Carbon::parse($shift->end_time)->format('H:i') }}</td>
            <td>{{ $shift->start_time }}</td>
            <td>{{ $shift->end_time }}</td>
            <td>{{ $shift->position }}</td>
            <td>
                <a href="{{ route('shift.edit', ['id' => $shift->id]) }}" class="btn btn-warning">Sửa</a>
                <a href="{{ route('shift.delete', ['id' => $shift->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Xóa</a>
            </td>
          </tr>
        @endforeach

        </tbody>
      </table>

</body>
</html>