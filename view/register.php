<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="/styles/style.css">
    <title>Login</title>
</head>

<form action="?c=Auth&m=registerProcess" method="POST">
    <label>Nama <input type="text" name="nama" required></label><br>
    <label>Email  <input type="email" name="email" required></label><br>
    <label>Password <input type="password" name="password" required></label><br>
    <button type="submit">Daftar</button>
</form>
<p>Sudah punya akun? <a href="?c=Auth&m=loginProcess">Login di sini</a></p>