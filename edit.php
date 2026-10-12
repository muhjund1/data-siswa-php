<?php
require "koneksi.php";
$id = filter_var($_GET["id"] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
die("ID tidak valid.");
}
$stmt = $pdo->prepare("SELECT * FROM siswa WHERE id = :id");
$stmt->execute(["id" => $id]);
$siswa = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$siswa) {
die("Siswa tidak ditemukan.");
}
$kelas = $pdo->query(
"SELECT id, nama_kelas FROM kelas ORDER BY nama_kelas"
)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Edit Siswa</title></head>
<body>
<h1>Edit Siswa</h1>
<form action="update.php" method="POST">
<input type="hidden" name="id"
value="<?php echo $siswa["id"]; ?>">
<p>Nama: <input name="nama" required
value="<?php echo htmlspecialchars($siswa["nama"]); ?>"></p>
<p>Email: <input type="email" name="email" required
value="<?php echo htmlspecialchars($siswa["email"]); ?>"></p>
<p>Alamat: <input name="alamat" required
value="<?php echo htmlspecialchars($siswa["alamat"] ?? ""); ?>"></p>
<p>Kelas:
<select name="kelas_id" required>
<?php foreach ($kelas as $k) { ?>
<option value="<?php echo $k["id"]; ?>"
<?php if ($k["id"] == $siswa["kelas_id"]) {
echo "selected";
} ?>>
<?php echo htmlspecialchars($k["nama_kelas"]); ?>
</option>
<?php } ?>
</select></p>
<button type="submit">Simpan Perubahan</button>
</form>
<a href="index.php">Batal</a>
</body>
</html>