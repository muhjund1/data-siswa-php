<?php
require "koneksi.php";
$kelas = $pdo->query(
"SELECT id, nama_kelas FROM kelas ORDER BY nama_kelas"
)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Tambah Siswa</title></head>
<body>
<h1>Tambah Siswa</h1>
<form action="simpan.php" method="POST">
<p>Nama: <input name="nama" type="text" required></p>
<p>Email: <input name="email" type="email" required></p>
<p>Alamat: <textarea name="alamat" required></textarea></p>
<p>Kelas:
<select name="kelas_id" required>
<option value="">Pilih kelas</option>
<?php foreach ($kelas as $k) { ?>
<option value="<?php echo $k["id"]; ?>">
<?php echo htmlspecialchars($k["nama_kelas"]); ?>
</option>
<?php } ?>
</select>
</p>
<button type="submit">Simpan</button>
</form>
<a href="index.php">Kembali</a>
</body>
</html>