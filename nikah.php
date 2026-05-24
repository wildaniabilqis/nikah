<?php
$conn = mysqli_connect("localhost", "root", "", "db_undangan");

if(!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}

if(isset($_POST['update'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kehadiran = mysqli_real_escape_string($conn, $_POST['kehadiran']);
    $jumlah = mysqli_real_escape_string($conn, $_POST['jumlah']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    mysqli_query($conn, "INSERT INTO data_tamu(nama, kehadiran, jumlah, pesan) VALUES (
        '$nama',
        '$kehadiran', 
        '$jumlah',
        '$pesan'
    )");

    header("location: nikah.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Rosyid & Bela</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Great+Vibes&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: #5c4d41;
            line-height: 1.8;
            padding: 30px 15px;
            display: flex;
            justify-content: center;
            background-image: url('img/foto 5.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .isi-undangan {
            max-width: 600px; 
            width: 100%;
            background: rgba(255, 255, 255, 0.65); 
            backdrop-filter: blur(10px); 
            -webkit-backdrop-filter: blur(10px); 
            padding: 45px 25px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(92, 77, 65, 0.15);
            text-align: center;
            border: 2px solid rgba(230, 211, 190, 0.6);
            position: relative;
        }
        
        .isi-undangan::before {
            content: '';
            position: absolute;
            top: 15px; left: 15px; right: 15px; bottom: 15px;
            border: 1px solid rgba(170, 132, 83, 0.2);
            border-radius: 14px;
            pointer-events: none;
        }

        .basmalah {
            font-family: 'Times New Roman', serif;
            font-size: 1.5rem;
            color: #aa8453;
            margin-bottom: 25px;
            letter-spacing: 1px;
            font-weight: bold;
        }

        .sub-title-top {
            letter-spacing: 3px; 
            font-size: 0.75rem; 
            font-weight: 600; 
            color: #8c7662;
        }

        .foto-banner {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 12px;
            margin: 25px 0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            border: 1px solid #e6d3be;
        }

        .foto-profil {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 50%; 
            margin: 15px auto;
            border: 3px solid #aa8453;
            padding: 4px;
            background: #ffffff;
            display: block;
            box-shadow: 0 6px 15px rgba(0,0,0,0.06);
        }

        /* --- STYLING GALLERY FOTO --- */
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 12px; 
            margin-top: 20px;
        }

        .gallery-item {
            width: 100%;
            height: 180px; 
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e6d3be;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.03); 
            box-shadow: 0 6px 15px rgba(170, 132, 83, 0.25);
        }

        /* --- STYLING AUDIO TERSEMBUYNI --- */
        #bgm-audio {
            display: none;
        }

        .btn-undangan, 
        .login-container .btn-tambah,
        a[href*="Lokasi"] {
            display: inline-block;
            padding: 12px 35px;
            background: linear-gradient(135deg, #aa8453, #bfa08a); 
            color: #ffffff !important;   
            text-decoration: none !important; 
            border-radius: 30px;        
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            border: none;
            box-shadow: 0 5px 15px rgba(170, 132, 83, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
            margin: 20px 0;
        }

        .btn-undangan:hover, 
        .login-container .btn-tambah:hover,
        a[href*="Lokasi"]:hover {
            background: linear-gradient(135deg, #8c683c, #a6846c);
            transform: translateY(-2px); 
            box-shadow: 0 8px 20px rgba(140, 104, 60, 0.4);
        }

        h1, h2, h3, h4 {
            color: #7a634e;
            margin-bottom: 10px;
        }

        h1 { 
            font-family: 'Great Vibes', cursive;
            font-size: 3.2rem; 
            color: #aa8453;
            margin: 10px 0; 
            font-weight: normal;
        }
        
        h2 { 
            font-family: 'Cinzel', serif;
            font-size: 1.4rem; 
            letter-spacing: 2px;
            margin-top: 40px; 
            margin-bottom: 25px; 
            color: #aa8453;
        }
        
        h3 { 
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #5c4d41;
        }
        
        h4 { 
            font-family: 'Cinzel', serif;
            font-size: 1rem; 
            margin-top: 25px; 
            color: #aa8453;
            letter-spacing: 1px;
        }

        .tanggal-cover {
            display: inline-block;
            background-color: #f7f1eb;
            border: 1px solid #e6d3be;
            padding: 6px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #7a634e;
            margin-top: 10px;
        }

        .quotes-caption {
            font-size: 0.9rem; 
            color: #7a634e;
        }

        .salam-pembuka {
            font-size: 0.85rem; 
            margin-top: 10px;
        }

        .text-separator {
            margin: 20px 0; 
            font-family: 'Great Vibes', cursive; 
            font-size: 2rem; 
            color: #c5a880;
        }

        .mempelai-nama {
            color: #aa8453; 
            font-size: 1.15rem;
        }

        .mempelai-ortu {
            font-size: 0.8rem; 
            color: #94806e; 
            margin-top: 3px;
        }

        .kisah-text {
            font-size: 0.85rem;
        }

        hr {
            border: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, #e6d3be, transparent);
            margin: 35px 0;
        }

        blockquote {
            font-style: italic;
            background: rgba(247, 241, 235, 0.6);
            padding: 20px;
            border-left: 3px solid #aa8453;
            margin: 25px 0;
            border-radius: 8px;
            font-size: 0.85rem;
            line-height: 1.6;
            box-shadow: inset 0 0 10px rgba(255,255,255,0.5);
        }

        blockquote b {
            color: #aa8453; 
            display: block; 
            margin-top: 5px;
        }

        .box-waktu-acara {
            background: #faf6f2; 
            padding: 20px 15px; 
            border-radius: 12px; 
            border: 1px solid #efe4dc;
        }
        .box-waktu-acara h3 span {
            font-size: 1.2rem;
        }
        .box-waktu-acara p {
            font-size: 0.85rem;
        }
        .box-waktu-acara p.tgl-acara {
            font-weight: 600;
        }
        .box-waktu-acara p.lokasi-acara {
            color: #7a634e; 
            margin-top: 5px;
        }

        .login-container {
            background: #fdfaf7;
            padding: 30px 20px;
            border-radius: 14px;
            margin: 40px 0;
            text-align: left; 
            border: 1px solid #e6d3be;
            box-shadow: 0 4px 15px rgba(92, 77, 65, 0.02);
        }

        .login-container h2 {
            font-size: 1.3rem;
            margin-top: 0;
            margin-bottom: 25px;
            text-align: center;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #7a634e;
            margin-bottom: 4px;
        }

        .login-container input[type="text"],
        .login-container input[type="number"],
        .login-container select {
            width: 100%;
            padding: 12px;
            margin-top: 4px;
            margin-bottom: 18px;
            border: 1px solid #e6d3be;
            border-radius: 8px;
            background-color: #ffffff;
            font-size: 0.9rem;
            color: #4a4a4a;
            font-family: 'Montserrat', sans-serif;
            outline: none;
            transition: all 0.3s;
        }

        .login-container input:focus,
        .login-container select:focus {
            border-color: #aa8453;
            box-shadow: 0 0 8px rgba(170, 132, 83, 0.2);
        }

        .login-container .btn-tambah {
            width: 100%;
            margin: 5px 0 0 0;
            padding: 14px;
            font-size: 0.9rem;
        }

        footer {
            margin-top: 45px;
            border-top: 1px solid #e6d3be;
            padding-top: 35px;
            font-size: 0.85rem;
            color: #6e5d4f;
        }

        footer h3 {
            font-size: 1rem;
            margin: 25px 0;
            font-weight: 600;
        }

        footer p.sub-bahagia {
            font-size: 0.8rem; 
            letter-spacing: 1px;
        }

        footer b {
            font-family: 'Great Vibes', cursive;
            color: #aa8453;
            font-size: 2.5rem;
            display: block;
            margin-top: 10px;
            font-weight: normal;
        }

        @media (max-width: 480px) {
            .gallery-container {
                grid-template-columns: 1fr;
            }
            .gallery-item {
                height: 220px;
            }
        }
    </style>
</head>
<body>

    <audio id="bgm-audio" loop>
        <source src="lesung pipi.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <div class="isi-undangan">
        <div class="basmalah">بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ</div>

        <section class="isi-konten">
            <p class="sub-title-top">UNDANGAN PERNIKAHAN</p>
            <h1>Rosyid & Bela</h1>
            <div class="tanggal-cover">Selasa, 03 Mei 2030</div>
            
            <img src="img/berdua.jpg" alt="Foto Rosyid dan Bela" class="foto-banner">
            
            <p class="quotes-caption"><i>"Dua hati, satu tujuan, dalam ikatan suci"</i></p>
        </section>

        <hr> 

        <section>
            <h3>Assalamu’alaikum Warahmatullahi Wabarakatuh</h3>
            <p class="salam-pembuka">
                Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud mengundang 
                Bapak/Ibu/Saudara/i untuk hadir di acara pernikahan kami.
            </p>
            <blockquote>
                "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri 
                dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya..." 
                <br><b>(QS. Ar-Rum: 21)</b>
            </blockquote>
        </section>

        <section>
            <h2>Mempelai Pernikahan</h2>
            
            <div style="margin-top: 25px;">
                <img src="img/cowo.jpg" alt="Misbahur Rosyidi" class="foto-profil">
                <h3 class="mempelai-nama">Misbahur Rosyidi Al-hafiz</h3>
                <p class="mempelai-ortu">Putra ketiga dari Bapak Aris Nugraha & Ibu Linda Kusuma </p>
            </div>

            <p class="text-separator">dengan</p>

            <div style="margin-bottom: 25px;">
                <img src="img/cewe.jpg" alt="Annisa Bela Agniya" class="foto-profil">
                <h3 class="mempelai-nama">Annisa Bela Agniya Ariansyah</h3>
                <p class="mempelai-ortu">Putri pertama dari Bapak Aryanto & Ibu Siti Barokah</p>
            </div>
        </section>

        <hr>

        <section>
            <h2>Kisah Cinta Kami</h2>
            
            <h4>Awal Bertemu (2025)</h4>
            <p class="kisah-text">Kami pertama kali bertemu di sebuah acara komunitas...</p>

            <h4>Masa Perkenalan (2026)</h4>
            <p class="kisah-text">Setelah sekian lama berteman, kami menyadari adanya kecocokan...</p>

            <h4>Lamaran (2030)</h4>
            <p class="kisah-text">Kami memutuskan untuk melangkah ke jenjang yang lebih serius...</p>
        </section>
        
        <hr>

        <section>
            <h2>Gallery Kebersamaan</h2>
            <div class="gallery-container">
                <img src="img/foto 9.jpg" alt="Foto Galeri 9" class="gallery-item">
                <img src="img/foto 8.jpg" alt="Foto Galeri 8" class="gallery-item">
                <img src="img/foto 6.jpg" alt="Foto galeri 6" class="gallery-item">
                <img src="img/foto 10.jpg" alt="Foto Galeri 10" class="gallery-item">
            </div>
        </section>

        <hr>

        <section>
            <h2>Waktu & Tempat Acara</h2>

            <div class="box-waktu-acara" style="margin-bottom: 30px;">
                <h3><span>✿</span> Akad Nikah</h3>
                <p class="tgl-acara">Selasa, 02 Maret 2030</p>
                <p>08.00 - 10.00 WIB</p>
                <p class="lokasi-acara">Masjid Raya Al-Barokah, Jakarta</p>
            </div>

            <div class="box-waktu-acara">
                <h3><span>✿</span> Resepsi</h3>
                <p class="tgl-acara">Selasa, 03 Mei 2030</p>
                <p>11.00 - 14.00 WIB</p>
                <p>The Gaia Hotel (Bandung)</p>
            </div>
            
            <div style="margin-top: 30px;">
                <h3>Lokasi pesta</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.3882650454225!2d107.59808467410544!3d-6.843970766950312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e135072c50e7%3A0x189c0c83fb5b8391!2sThe%20Gaia%20Hotel%20Bandung!5e0!3m2!1sen!2sid!4v1769652876208!5m2!1sen!2sid"
                width="100%"
                height="280" 
                style="border:0;"
                allowfullscreen="" 
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </section>

        <div class="login-container">
            <h2>Buku Tamu & Ucapan</h2>
            <form method="post">
                <label>Nama Tamu :</label>
                <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required>
                
                <label>Kehadiran Tamu :</label>
                <select name="kehadiran" required>
                    <option value="">pilih</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Insyaallah hadir">Insyaallah hadir</option>
                    <option value="Tidak hadir">Tidak hadir</option>
                </select>
                
                <label>Jumlah Tamu :</label>
                <input type="number" name="jumlah" placeholder="Contoh: 2" required>
                
                <label>Ucapan & Do'a :</label>
                <input type="text" name="pesan" placeholder="Tulis ucapan & doa restu Anda" required>

                <button type="submit" name="update" class="btn btn-tambah">Update Data</button>
            </form>
        </div>

        <footer>
            <p>
                Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila 
                Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.
            </p>
            <h3>Wassalamu’alaikum Warahmatullahi Wabarakatuh</h3>
            <p class="text-bahagia">Kami yang berbahagia,</p>
            <b>Rosyid & Bela</b>
        </footer>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const audio = document.getElementById('bgm-audio');
            
            audio.volume = 0.6;

            const playAudio = () => {
                audio.play().then(() => {
                    document.removeEventListener('click', playAudio);
                    document.removeEventListener('touchstart', playAudio);
                    window.removeEventListener('scroll', playAudio);
                }).catch(error => {
                    console.log("Autoplay dicegah oleh browser, menunggu interaksi user.");
                });
            };

            document.addEventListener('click', playAudio);
            document.addEventListener('touchstart', playAudio);
            window.addEventListener('scroll', playAudio);
        });
    </script>
</body>
</html>