<?php
include 'koneksi.php';

if(isset($_POST['update'])){
    mysqli_query($conn, "INSERT INTO data_tamu(nama, kehadiran, jumlah, pesan) VALUES (
        '$_POST[nama]',
        '$_POST[kehadiran]',
        '$_POST[jumlah]',
        '$_POST[pesan]'
    )");

    header("location: data_tamu.php");
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Tamu</title>
    <style>
        /* --- RESET & BASE STYLE --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Helvetica, Arial, sans-serif;
        }

        body {
            /* Background gradien linear ungu-biru lembut agar serasi dengan halaman lain */
            background: linear-gradient(135deg, #e0e7ff 0%, #e0f2fe 50%, #f3e8ff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* --- CARD CONTAINER --- */
        .login-container {
            background: #ffffff;
            width: 100%;
            max-width: 500px; /* Lebar form proporsional */
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 
                        0 20px 25px -5px rgba(30, 41, 59, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        /* --- JUDUL FORM --- */
        h2 {
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

        /* --- INPUT FIELDS & SELECT DROPDOWN --- */
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            color: #1e293b;
            outline: none;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }

        /* Khusus input teks ucapan/pesan berupa textarea atau input tinggi */
        input[name="pesan"] {
            padding-bottom: 25px; /* Memberikan sedikit ruang lega untuk teks ucapan */
        }

        /* Efek fokus menyala ketika komponen form diklik */
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
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

        /* Tombol Simpan (Ungu Premium) */
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

        /* Tombol Batal (Abu-abu Netral) */
        .btn-batal {
            background-color: #f1f5f9;
            color: #64748b;
            border: 1.5px solid #e2e8f0;
        }

        .btn-batal:hover {
            background-color: #e2e8f0;
            color: #475569;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>TAMBAH DATA TAMU</h2>
        
        <form method="post">
            <div class="form-group">
                <label>Nama Tamu</label>
                <input type="text" name="nama" placeholder="Masukkan nama tamu" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Kehadiran</label>
                <select name="kehadiran" required>
                    <option value="" disabled selected>Pilih status kehadiran</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Insyaallah hadir">Insyaallah hadir</option>
                    <option value="Tidak hadir">Tidak hadir</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jumlah Pendamping</label>
                <input type="number" name="jumlah" min="1" placeholder="Contoh: 1 atau 2" required>
            </div>

            <div class="form-group">
                <label>Ucapan & Do'a</label>
                <input type="text" name="pesan" placeholder="Tulis ucapan selamat..." required>
            </div>

            <div class="button-group">
                <a href="data_tamu.php" class="btn btn-batal">Batal</a>
                <button type="submit" name="update" class="btn btn-tambah">Simpan Tamu</button>
            </div>
        </form>
    </div>

</body>
</html>

