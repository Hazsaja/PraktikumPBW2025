
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="login">
    <div class="login-box">
        <div class="text-box">
            <h5>Selamat Datang</h5>
            <p>Harap Masukan Email anda yang telah terdaftar</p>
            
            <?php if(isset($error)): ?>
                <p style="color: red; font-size: 12px; text-align: center;"><?= $error; ?></p>
            <?php endif; ?>
        </div>

        <form action="proses_login.php" method="POST">
            <div class="inputLogin-box">
                <input type="text" name="username" class="nik" placeholder="Username" required>
                <input type="password" name="password" class="pass" placeholder="Kata Sandi" required>
            </div>
            <div class="check-forgot">
                <div class="checkbox-box">
                    <input type="checkbox">
                    <p>Ingat saya</p>
                </div>
                <a href="#">Lupa Kata Sandi</a>
            </div>
            <div class="login-button">
                <button type="submit" name="masuk">Masuk</button>  
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>