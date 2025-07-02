<?php
include '../config.php';
$stmt = $pdo->query("SELECT * FROM classes");
$classes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Daftar Kelas</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">Admin Panel</div>
            <nav class="nav-links">
                <a href="add.php"><i class="fas fa-plus-circle"></i> Tambah Kelas</a>
                <a href="../index.php"><i class="fas fa-home"></i> Beranda</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="card">
            <h2><i class="fas fa-chalkboard-teacher"></i> Daftar Kelas Trading</h2>
            
            <?php if (count($classes) > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Deskripsi</th>
                            <th>Periode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($classes as $class): ?>
                            <tr>
                                <td><?= htmlspecialchars($class['name']) ?></td>
                                <td><?= htmlspecialchars($class['description']) ?></td>
                                <td><?= date('d M Y', strtotime($class['start_date'])) ?> s/d <?= date('d M Y', strtotime($class['end_date'])) ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $class['id'] ?>" class="btn"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="delete.php?id=<?= $class['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus kelas ini?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert">
                    <p>Tidak ada kelas yang tersedia. <a href="add.php">Tambahkan kelas baru</a></p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>