<?php
$conn = mysqli_connect("localhost", "root", "", "db_undangan");

if(!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Helvetica, Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e0e7ff 0%, #e0f2fe 50%, #f3e8ff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* Mengubah arah layout menjadi vertikal (ke bawah) */
        }

        /* Mengubah fungsi dari Sidebar menjadi Navbar Atas */
        .navbar {
            width: 100%;
            height: 70px;
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 4px 25px -5px rgba(30, 41, 59, 0.05);
        }

        .navbar .brand {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #4f46e5, #6d28d9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .navbar menu {
            list-style: none;
            display: flex;
            gap: 15px; /* Menu berjejer ke samping */
            align-items: center;
        }

        .navbar menu a {
            display: block;
            padding: 10px 20px;
            color: #475569;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .navbar menu a.active, .navbar menu a:hover {
            color: #4f46e5;
            background-color: #f5f3ff;
        }

        .navbar .logout-btn {
            padding: 10px 20px;
            color: #64748b;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            border-radius: 10px;
            border: 1.5px solid #cbd5e1;
            text-align: center;
            transition: all 0.2s ease;
        }

        .navbar .logout-btn:hover {
            color: #ef4444;
            border-color: #fca5a5;
            background-color: #fef2f2;
        }

        /* Menyesuaikan jarak konten utama agar tidak tertutup navbar */
        .main-content {
            margin-top: 70px; /* Sesuai dengan tinggi navbar */
            flex-grow: 1;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .login-container {
            background: #ffffff;
            width: 100%;
            max-width: 1100px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 
                        0 20px 25px -5px rgba(30, 41, 59, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        h1 {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #4338ca, #6d28d9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
        }

        .action-header {
            display: flex;
            justify-content: flex-start; 
            align-items: center;
            margin-bottom: 25px;
        }

        .btn {
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 11px 22px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

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

        .table-responsive {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.01);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            background-color: #ffffff;
        }

        th {
            background-color: #f8fafc; 
            color: #475569;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 18px 24px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        tr:hover td {
            background-color: #f5f3ff !important; 
        }

        tr:last-child td {
            border-bottom: none;
        }

        .action-group {
            display: flex;
            gap: 8px; 
            align-items: center;
        }

        .action-link {
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px; 
            border-radius: 6px;
            display: inline-block;
            transition: all 0.2s ease;
        }

        .link-edit {
            color: #4f46e5;
            background-color: #e0e7ff;
        }

        .link-edit:hover {
            background-color: #4f46e5;
            color: #ffffff;
        }

        .link-delete {
            color: #b91c1c;
            background-color: #fee2e2;
        }

        .link-delete:hover {
            background-color: #b91c1c;
            color: #ffffff;
        }

        /* Responsif untuk layar HP agar susunan menu rapi jika dibuka di layar kecil */
        @media (max-width: 768px) {
            .navbar {
                padding: 0 15px;
                height: auto;
                flex-direction: column;
                gap: 10px;
                padding-top: 15px;
                padding-bottom: 15px;
                position: relative;
            }
            .navbar menu {
                flex-wrap: wrap;
                justify-content: center;
            }
            .main-content {
                margin-top: 0;
                padding: 20px 10px;
            }
        }
    </style>
</head>
<body>
    
    <div class="navbar">
        <div class="brand">UNDANGAN DIGITAL</div>
        
        <menu>
            <a href="data_user.php" class="active">Data Pengguna</a>
            <a href="../data tamu/data_tamu.php">Data Tamu</a>
        </menu>

        <a href="../logout.php" class="logout-btn" onclick="return confirm('Apakah anda yakin ingin logout?')">Logout</a>
    </div>

    <div class="main-content">
        <div class="login-container">
            <h1>USER MANAGEMENT SYSTEM</h1>
            
            <div class="action-header">
                <a href="tambah.php" class="btn btn-tambah"> + Tambah Data Baru </a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 130px;">Id</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $data = mysqli_query($conn, "SELECT * from data_user ORDER BY nama ASC");
                            $no = 6221;
                            while($item = mysqli_fetch_array($data)) {
                                $id_bagus = "USR-" . str_pad($no, 4, "0", STR_PAD_LEFT);
                        ?>
                        <tr>
                            <td><?= $id_bagus; ?></td>
                            <td><?= htmlspecialchars($item['nama']); ?></td>
                            <td><?= htmlspecialchars($item['email']); ?></td>
                            <td>•••••</td>
                            <td>
                                <div class="action-group">
                                    <a href="edit.php?id=<?= $item['id']; ?>" class="action-link link-edit">Edit</a>
                                    <a href="hapus.php?id=<?= $item['id']; ?>" class="action-link link-delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php
                                $no++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>