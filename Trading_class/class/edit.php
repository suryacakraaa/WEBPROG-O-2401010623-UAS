<?php
include '../config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: list.php");
    exit();
}

// Ambil data lama
$stmt = $pdo->prepare("SELECT * FROM classes WHERE id = ?");
$stmt->execute([$id]);
$class = $stmt->fetch();

if (!$class) {
    echo "Kelas tidak ditemukan.";
    exit();
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $stmt = $pdo->prepare("UPDATE classes SET name = ?, description = ?, start_date = ?, end_date = ? WHERE id = ?");
    $stmt->execute([$name, $description, $start_date, $end_date, $id]);

    // Tambahkan pesan sukses
    $_SESSION['success_message'] = "Kelas berhasil diperbarui!";
    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas Trading</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .edit-header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .edit-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .edit-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .edit-card-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }
        
        .edit-card-body {
            padding: 25px;
        }
        
        .form-section {
            margin-bottom: 25px;
        }
        
        .form-section h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #f1f1f1;
        }
        
        .date-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        @media (max-width: 768px) {
            .date-fields {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="edit-header">
        <div class="container">
            <h1><i class="fas fa-edit"></i> Edit Kelas Trading</h1>
            <p>Perbarui detail kelas trading Anda</p>
        </div>
    </header>

    <main class="edit-container">
        <div class="edit-card">
            <div class="edit-card-header">
                <h2><i class="fas fa-chalkboard-teacher"></i> Form Edit Kelas</h2>
            </div>
            
            <div class="edit-card-body">
                <form method="POST">
                    <div class="form-section">
                        <h3><i class="fas fa-info-circle"></i> Informasi Dasar</h3>
                        
                        <div class="form-group">
                            <label><i class="fas fa-tag"></i> Nama Kelas</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($class['name']) ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-align-left"></i> Deskripsi</label>
                            <textarea name="description" class="form-control" rows="5" required><?= htmlspecialchars($class['description']) ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3><i class="far fa-calendar-alt"></i> Periode Kelas</h3>
                        
                        <div class="date-fields">
                            <div class="form-group">
                                <label><i class="fas fa-calendar-day"></i> Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" value="<?= $class['start_date'] ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label><i class="fas fa-calendar-check"></i> Tanggal Selesai</label>
                                <input type="date" name="end_date" class="form-control" value="<?= $class['end_date'] ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" style="display: flex; gap: 10px;">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="list.php" class="btn">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Animasi saat form di-submit
            $('form').on('submit', function() {
                $('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
            });
            
            // Validasi tanggal
            $('input[type="date"]').change(function() {
                const startDate = new Date($('input[name="start_date"]').val());
                const endDate = new Date($('input[name="end_date"]').val());
                
                if (endDate < startDate) {
                    alert('Tanggal selesai tidak boleh sebelum tanggal mulai!');
                    $('input[name="end_date"]').val('');
                }
            });
        });
    </script>
</body>
</html>