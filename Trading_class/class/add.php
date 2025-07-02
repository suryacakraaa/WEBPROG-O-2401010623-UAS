<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $stmt = $pdo->prepare("INSERT INTO classes (name, description, start_date, end_date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $start_date, $end_date]);

    $_SESSION['success_message'] = "Kelas baru berhasil ditambahkan!";
    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas Trading Baru</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .create-header {
            background: linear-gradient(135deg, #27ae60, #219150);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
            text-align: center;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .create-header::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .create-header::after {
            content: "";
            position: absolute;
            bottom: -80px;
            left: -30px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .create-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .create-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transform: translateY(-20px);
            margin-bottom: 40px;
            border: 1px solid #e0e0e0;
        }
        
        .create-card-header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
        }
        
        .create-card-header i {
            font-size: 24px;
            margin-right: 15px;
            color: #27ae60;
        }
        
        .create-card-body {
            padding: 30px;
        }
        
        .form-section {
            margin-bottom: 30px;
            animation: fadeIn 0.5s ease-out;
        }
        
        .form-section h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f1f1;
            display: flex;
            align-items: center;
        }
        
        .form-section h3 i {
            margin-right: 10px;
            color: #3498db;
        }
        
        .date-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }
        
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .form-note {
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 5px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 768px) {
            .date-fields {
                grid-template-columns: 1fr;
            }
            
            .form-footer {
                flex-direction: column-reverse;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <header class="create-header">
        <div class="container">
            <h1><i class="fas fa-plus-circle"></i> Tambah Kelas Trading Baru</h1>
            <p>Buat kelas trading baru untuk peserta Anda</p>
        </div>
    </header>

    <main class="create-container">
        <div class="create-card">
            <div class="create-card-header">
                <i class="fas fa-chalkboard-teacher"></i>
                <h2>Formulir Pembuatan Kelas</h2>
            </div>
            
            <div class="create-card-body">
                <form method="POST" id="classForm">
                    <div class="form-section">
                        <h3><i class="fas fa-info-circle"></i> Informasi Kelas</h3>
                        
                        <div class="form-group">
                            <label><i class="fas fa-tag"></i> Nama Kelas</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Forex Dasar, Crypto Advanced" required>
                            <p class="form-note">Nama yang jelas dan deskriptif akan lebih menarik bagi peserta</p>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-align-left"></i> Deskripsi Kelas</label>
                            <textarea name="description" class="form-control" rows="6" placeholder="Jelaskan apa yang akan dipelajari, manfaat kelas, dan target peserta..." required></textarea>
                            <p class="form-note">Gunakan bahasa yang menarik dan jelas. Minimal 50 karakter.</p>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3><i class="far fa-calendar-alt"></i> Jadwal Kelas</h3>
                        
                        <div class="date-fields">
                            <div class="form-group">
                                <label><i class="fas fa-calendar-day"></i> Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <label><i class="fas fa-calendar-check"></i> Tanggal Selesai</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>
                        <p class="form-note">Pastikan periode kelas sudah benar sebelum dipublikasikan</p>
                    </div>
                    
                    <div class="form-footer">
                        <a href="list.php" class="btn">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Kelas Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Animasi submit form
            $('#classForm').on('submit', function() {
                $('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
            });
            
            // Validasi tanggal
            $('input[type="date"]').change(function() {
                const startDate = new Date($('input[name="start_date"]').val());
                const endDate = new Date($('input[name="end_date"]').val());
                
                if (startDate && endDate && endDate < startDate) {
                    alert('Tanggal selesai tidak boleh sebelum tanggal mulai!');
                    $('input[name="end_date"]').val('');
                }
            });
            
            // Validasi panjang deskripsi
            $('textarea[name="description"]').on('input', function() {
                if ($(this).val().length < 50) {
                    $(this).css('border-color', '#e74c3c');
                    $('.form-note').eq(1).css('color', '#e74c3c');
                } else {
                    $(this).css('border-color', '#ddd');
                    $('.form-note').eq(1).css('color', '#7f8c8d');
                }
            });
            
            // Set tanggal minimal hari ini
            const today = new Date().toISOString().split('T')[0];
            $('input[type="date"]').attr('min', today);
        });
    </script>
</body>
</html>