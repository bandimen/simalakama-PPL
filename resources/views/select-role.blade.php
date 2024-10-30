<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
</head>
<body>
    <h1>Pilih Role</h1>
    <form action="{{ route('selectRole') }}" method="POST">
        @csrf
        @foreach ($roles as $role)
            <div>
                <input type="radio" name="role" value="{{ $role->name }}" id="{{ $role->name }}">
                <label for="{{ $role->name }}">{{ ucfirst($role->name) }}</label>
            </div>
        @endforeach
        <button type="submit">Lanjutkan</button>
    </form>
</body>
</html>
