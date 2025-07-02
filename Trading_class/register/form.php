<?php
include '../config.php';

// Ambil data kelas untuk dropdown
$stmt = $pdo->query("SELECT * FROM classes");
$classes = $stmt->fetchAll();

// Jika ada class_id di URL, set sebagai selected
$selected_class = $_GET['class_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Kelas Trading</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">Trading Academy</div>
            <nav class="nav-links">
                <a href="../index.php"><i class="fas fa-home"></i> Beranda</a>
                <a href="list_peserta.php"><i class="fas fa-users"></i> Daftar Peserta</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="card">
            <h2><i class="fas fa-user-plus"></i> Form Pendaftaran Kelas Trading</h2>
            
            <form action="submit.php" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap:</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>No. HP / WA:</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tingkat Pengalaman:</label>
                    <select name="experience_level" class="form-control" required>
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pesan (opsional):</label>
                    <textarea name="message" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Pilih Kelas:</label>
                    <select name="class_id" class="form-control" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['id'] ?>" <?= $selected_class == $class['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($class['name']) ?> (<?= date('d M Y', strtotime($class['start_date'])) ?> - <?= date('d M Y', strtotime($class['end_date'])) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit Pendaftaran</button>
                <a href="../index.php" class="btn"><i class="fas fa-arrow-left"></i> Kembali</a>
            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>