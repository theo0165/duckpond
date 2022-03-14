<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div>
        <div>
            <h1>Reset Password</h1>
            <p>Click <a href="{{ route('resetpassword.show', $token) }}">here</a> to reset your password.</p>
            <p>Or paste this link to your browser:</p>
            <a href="{{ route('resetpassword.show', $token) }}" style="overflow-wrap: anywhere;">{{ route('resetpassword.show', $token) }}</a>
        </div>
    </div>
</body>
</html>
