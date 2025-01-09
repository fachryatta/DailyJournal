<?php
include 'koneksi.php'; // file untuk koneksi ke database

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Ambil data user berdasarkan username
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Jika tombol simpan ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $foto_lama = $user['foto'];

    $foto_baru = $foto_lama; // Default tetap foto lama

    // Proses upload file foto baru jika ada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES['foto']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi tipe file
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $foto_baru = basename($_FILES['foto']['name']);
                if ($foto_lama && file_exists($target_dir . $foto_lama)) {
                    unlink($target_dir . $foto_lama); // Hapus foto lama
                }
            }
        }
    }

    // Update password jika diisi
    if (!empty($password)) {
        $password = md5($password);
    } else {
        $password = $user['password']; // Tetap gunakan password lama jika tidak diubah
    }

    // Update data ke database
    $stmt = $conn->prepare("UPDATE user SET password = ?, foto = ? WHERE username = ?");
    $stmt->bind_param("sss", $password, $foto_baru, $username);
    if ($stmt->execute()) {
        echo "<script>alert('Profil berhasil diperbarui.'); window.location='profile.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui profil.'); window.location='profile.php';</script>";
    }
}
?>



<div class="container mt-5">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="password" class="form-label">Ganti Password</label>
                <input type="password" class="form-control" name="password" placeholder="Tuliskan password baru jika ingin mengganti password saja">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Ganti Foto Profil</label>
                <input type="file" class="form-control" name="foto">
            </div>
            <div class="mb-3">
                <label for="currentFoto" class="form-label">Foto Profil Saat Ini</label><br>
                <img src="img/<?= htmlspecialchars($user['foto']) ?>" alt="Foto Profil" width="150">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    