<?php
include '../config.php';

// Gabungkan tabel participants dan classes
$stmt = $pdo->query("
    SELECT p.*, c.name AS class_name 
    FROM participants p 
    JOIN classes c ON p.class_id = c.id
");
$participants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Kelas Trading</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">Daftar Peserta</div>
            <nav class="nav-links">
                <a href="../index.php"><i class="fas fa-home"></i> Beranda</a>
                <a href="form.php"><i class="fas fa-user-plus"></i> Pendaftaran Baru</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="card">
            <h2><i class="fas fa-users"></i> Daftar Peserta Kelas Trading</h2>
            
            <?php if (count($participants) > 0): ?>
                <div style="overflow-x: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Tingkat</th>
                                <th>Kelas</th>
                                <th>Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($participants as $p): ?>
                                <tr>
                                    <td><?= htmlspecialchars($p['full_name']) ?></td>
                                    <td><?= htmlspecialchars($p['email']) ?></td>
                                    <td><?= htmlspecialchars($p['phone']) ?></td>
                                    <td>
                                        <?php 
                                        $badge_class = [
                                            'Beginner' => 'badge-blue',
                                            'Intermediate' => 'badge-orange',
                                            'Advanced' => 'badge-green'
                                        ];
                                        ?>
                                        <span class="badge <?= $badge_class[$p['experience_level']] ?>">
                                            <?= $p['experience_level'] ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($p['class_name']) ?></td>
                                    <td><?= htmlspecialchars($p['message']) ?: '-' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert">
                    <p>Belum ada peserta yang terdaftar.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>