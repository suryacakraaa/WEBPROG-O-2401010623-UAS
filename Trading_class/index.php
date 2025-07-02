<?php
include 'config.php';
$stmt = $pdo->query("SELECT * FROM classes");
$classes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas Trading</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">Trading Academy</div>
            <nav class="nav-links">
                <a href="register/form.php"><i class="fas fa-user-plus"></i> Daftar Kelas</a>
                <a href="class/list.php"><i class="fas fa-user-shield"></i> Admin Panel</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Kelas Trading Profesional</h1>
            <p>Tingkatkan skill trading Anda dengan mentor berpengalaman dan materi terupdate</p>
            <a href="register/form.php" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Daftar Sekarang</a>
        </div>
    </section>

    <main class="container">
        <h2>Kelas Tersedia</h2>
        <div class="class-list">
            <?php foreach ($classes as $class): ?>
                <div class="class-card">
                    <div class="class-header">
                        <h3><?= htmlspecialchars($class['name']) ?></h3>
                    </div>
                    <div class="class-body">
                        <p><?= htmlspecialchars($class['description']) ?></p>
                        <p><strong><i class="far fa-calendar-alt"></i> Periode:</strong> <?= date('d M Y', strtotime($class['start_date'])) ?> - <?= date('d M Y', strtotime($class['end_date'])) ?></p>
                    </div>
                    <div class="class-footer">
                        <a href="register/form.php?class_id=<?= $class['id'] ?>" class="btn"><i class="fas fa-arrow-right"></i> Daftar Kelas Ini</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer style="background-color: var(--secondary-color); color: white; padding: 20px 0; text-align: center; margin-top: 40px;">
        <div class="container">
            <p>&copy; <?= date('Y') ?> Trading Academy. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>