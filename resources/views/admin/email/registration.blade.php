<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hello BeSofty</title>
</head>

<body>
    <h1>Welcome to BeSofty</h1>
    <p>
        To active your account, please click on this <a href="{{ Request::root() }}/admin/active/{{ $remember_token }}" target="_blank">link.</a>
    </p>
</body>

</html>