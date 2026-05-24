<?php
$conn = mysqli_connect("localhost", "root", "", "db_undangan");

if(!$conn) {
    die ("koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sampul</title>
    <style>
                @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');

        /* 2. RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f4f0;
            font-family: 'Montserrat', sans-serif;
            color: #5d534a;
            overflow-x: hidden; /* Mencegah geser kanan-kiri */
        }

        /* LOGIKA BUKA (Wajib ada) */
        #buka-check { display: none; }
        #buka-check:checked ~ .cover-page { display: none; }
        #buka-check:checked ~ .isi-undangan { display: block; }
        :has(#buka-check:checked) { overflow: auto; }

        /* 3. CONTAINER COVER (Full Screen & Center) */
        .container {
            height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            padding: 20px;
            background: #f8f4f0;
            overflow: hidden;
        }

        /* Inisial R&B Besar di Background */
        .bg-text {
            position: absolute;
            font-family: 'Great Vibes', cursive;
            font-size: 12rem;
            color: rgba(184, 146, 106, 0.07);
            z-index: 0;
            pointer-events: none;
        }

        /* 4. TYPOGRAPHY */
        .initials {
            font-family: 'Great Vibes', cursive;
            font-size: 2.5rem;
            color: #b8926a;
            margin-bottom: 5px;
            z-index: 1;
        }

        .header-text {
            letter-spacing: 4px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #8a7d6e;
            margin-bottom: 20px;
            z-index: 1;
        }

        .couple-names {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            color: #4a443e;
            line-height: 1.2;
            margin-bottom: 15px;
            z-index: 1;
        }

        .date {
            font-size: 1rem;
            letter-spacing: 3px;
            font-weight: 400;
            z-index: 1;
        }

        .slogan {
            font-family: 'Great Vibes', cursive;
            font-size: 1.8rem;
            color: #b8926a;
            margin: 20px 0 40px;
            z-index: 1;
        }

        /* 5. GUEST BOX (Kotak Nama Tamu) */
        .guest-box {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px 40px;
            border-radius: 15px;
            border: 1px solid rgba(184, 146, 106, 0.2);
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            margin-bottom: 30px;
            z-index: 1;
        }

        .guest-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #4a443e;
            margin-top: 5px;
        }

        /* Gaya Tombol Undangan Standar / Populer */
        .btn-undangan {
            display: inline-block;
            padding: 12px 35px;
            background-color: #bfa08a; 
            color: #ffffff !important;  
            text-decoration: none;     
            border-radius: 30px;       
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-undangan:hover {
            background-color: #a6846c;
            transform: translateY(-2px); 
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        /* RESPONSIVE HP */
        @media (max-width: 600px) {
            .couple-names { font-size: 2.5rem; }
            .bg-text { font-size: 8rem; }
            .guest-box { width: 90%; }
        }
    </style>
</head>
<body>

    <input type="checkbox" id="buka-check">

    <div class="container cover-page">
        <div class="bg-text">R&B</div>
        
        <div class="initials">R & B</div>
        <div class="header-text">YOU ARE INVITED TO THE WEDDING OF</div>
        <h1 class="couple-names">Rosyid & Bela</h1>
        <p class="date">MINGGU, 12 DESEMBER 2026</p>
        <p class="slogan"> With Joyfull Hearts</p>

        <div class="guest-box">
            <p>Kepada Yth. Bapak/Ibu/Saudara/i</p>
            <div class="guest-name">Nama Tamu</div>
            <p>Di Tempat</p>
        </div>

        <label for="buka-check" class="btn-open">
            <a href="nikah.php" class="btn-undangan">Buka Undangan</a>
        </label>
    </div>
</body>
</html>