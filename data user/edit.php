<?php
include 'koneksi.php';
$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * from data_user WHERE id= '$id'");
$item = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data User</title>
    <style>
        /* --- RESET & BASE STYLE --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Helvetica, Arial, sans-serif;
        }

        body {
            /* Background gradien linear serasi dengan dashboard utama */
            background: linear-gradient(135deg, #e0e7ff 0%, #e0f2fe 50%, #f3e8ff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* --- CARD CONTAINER --- */
        .container {
            background: #ffffff;
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 
                        0 20px 25px -5px rgba(30, 41, 59, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        /* --- JUDUL FORM --- */
        h1 {
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #4338ca, #6d28d9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
        }

        /* --- FORM LAYOUT --- */
        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- INPUT FIELDS --- */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            color: #1e293b;
            outline: none;
            transition: all 0.2s ease;
        }

        /* Efek fokus menyala ungu ketika kolom diklik */
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
        }

        /* --- ACTION BUTTON GROUP --- */
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 13px 20px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
        }

        /* Tombol Update (Ungu Premium) */
        .btn-tambah {
            background-color: #4f46e5;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .btn-tambah:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35);
        }

        /* Tombol Batal/Kembali (Abu-abu Netral) */
        .btn-batal {
            background-color: #f1f5f9;
            color: #64748b;
            border: 1.5px solid #e2e8f0;
            display: inline-block;
            line-height: 1.2;
        }

        .btn-batal:hover {
            background-color: #e2e8f0;
            color: #475569;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>PERBARUI DATA USER</h1>
        
        <form method="post">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($item['nama']); ?>" required>
            </div>

            <div class="form-group">
                <label>Alamat Email</label>
                <input type="text" name="email" value="<?= htmlspecialchars($item['email']); ?>" required>
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" value="<?= htmlspecialchars($item['password']); ?>" required>
            </div>

            <div class="button-group">
                <a href="data_user.php" class="btn btn-batal">Batal</a>
                <button type="submit" name="update" class="btn btn-tambah">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>

<?php
if(isset($_POST['update'])){
    mysqli_query($conn, "UPDATE data_user SET
        nama= '$_POST[nama]', 
        email= '$_POST[email]',
        password= '$_POST[password]'
        WHERE id='$id'
    ");

    header("location: data_user.php");
}
?>