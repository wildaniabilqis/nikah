<?php
session_start();

$username_benar = "admin"; 
$password_hash = password_hash("1234", PASSWORD_DEFAULT); 

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass_input = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($user_input === $username_benar && password_verify($pass_input, $password_hash)) {
        $_SESSION['username'] = $user_input;
        
        header("Location: data user/data_user.php");
        exit;
    } else {
        $error = "Username atau password yang kamu masukkan salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        /* --- RESET & BASE STYLE --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
        }

        body {
            /* Latar belakang diubah dari putih polos ke gradien ungu premium */
            background: linear-gradient(135deg, #e0e7ff 0%, #e0f2fe 50%, #f3e8ff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* --- CARD CONTAINER (Efek Pop-up Elegan) --- */
        .container {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 45px 40px;
            border-radius: 24px;
            /* Shadow dibuat lebih halus dan tebal di bawah */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 
                        0 20px 25px -5px rgba(30, 41, 59, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.7);
            transition: transform 0.3s ease;
        }

        /* --- JUDUL HALAMAN (Efek Gradien Teks) --- */
        h2 {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #4338ca, #6d28d9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin-bottom: 30px;
        }

        /* --- BOX ERROR --- */
        .error-box {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.02);
        }

        /* --- FORM INPUT GROUP --- */
        .input-group {
            margin-bottom: 22px;
            display: flex;
            flex-direction: column;
        }

        .input-group label {
            font-size: 11px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input-group input {
            width: 100%;
            padding: 13px 18px;
            font-size: 14px;
            color: #0f172a;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            outline: none;
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        /* Efek interaktif saat kolom input diklik */
        .input-group input:focus {
            border-color: #4f46e5;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
        }

        /* --- TOMBOL SUBMIT --- */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
            letter-spacing: 0.02em;
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        /* Efek melayang saat tombol di-hover */
        .btn-submit:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
    </style>
</head>
<body> 

<div class="container">
    <h2>SYSTEM LOGIN</h2>
    
    <?php if ($error): ?>
        <div class="error-box">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required autocomplete="username">
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required autocomplete="current-password">
        </div>
        <button type="submit" class="btn-submit">LOGIN</button>
    </form>
</div>

</body>
</html>