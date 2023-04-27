<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <h2>Thêm user</h2>
            <label for="">Name: </label><input type="text" name="name"><br>
            <label for="">Email: </label><input type="email" name="email"><br>
            <label for="">Password: </label><input type="password" name="password"><br>
            <label for="">Role: </label><br>
                <input type="radio" name="role" value="0"><label>Admin</label>
                <input type="radio" name="role" value="1"><label>User</label>
            <br>
            <button type="submit">Submit</button>
        </form>

    </body>
</html>
