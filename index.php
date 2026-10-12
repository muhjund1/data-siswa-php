<?php
require "koneksi.php";
$cari = trim($_GET["cari"] ?? "");
$stmt = $pdo->prepare(
"SELECT siswa.id, siswa.nama, siswa.email, siswa.alamat,
kelas.nama_kelas
FROM siswa
INNER JOIN kelas ON siswa.kelas_id = kelas.id
WHERE siswa.nama LIKE :cari
ORDER BY siswa.id DESC"
);
$stmt->execute(["cari" => "%" . $cari . "%"]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$jumlah = $pdo->query(
"SELECT kelas.nama_kelas, COUNT(siswa.id) AS total
FROM kelas LEFT JOIN siswa ON siswa.kelas_id = kelas.id
GROUP BY kelas.id, kelas.nama_kelas
ORDER BY kelas.nama_kelas"
)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Data Siswa</title></head>
<body>
<h1>Daftar Siswa</h1>
<a href="tambah.php">Tambah siswa</a>
<form method="GET" action="index.php">
<input name="cari" value="<?php echo htmlspecialchars($cari); ?>"
placeholder="Cari nama siswa">
<button type="submit">Cari</button>
</form>
<table border="1" cellpadding="6">
<tr><th>Nama</th><th>Email</th><th>Kelas</th><th>Alamat</th><th>Aksi</th></tr>
<?php foreach ($data as $s) { ?>
<tr>
<td><?php echo htmlspecialchars($s["nama"]); ?></td>
<td><?php echo htmlspecialchars($s["email"]); ?></td>
<td><?php echo htmlspecialchars($s["nama_kelas"]); ?></td>
<td><?php echo htmlspecialchars($s["alamat"] ?? ""); ?></td>
<td>
<a href="edit.php?id=<?php echo $s["id"]; ?>">Edit</a>
<form action="hapus.php" method="POST" style="display:inline">
<input type="hidden" name="id"
value="<?php echo $s["id"]; ?>">
<button type="submit">Hapus</button>
</form>
</td>
</tr>
<?php } ?>
</table>
<h2>Jumlah siswa per kelas</h2>
<?php foreach ($jumlah as $j) { ?>
<p><?php echo htmlspecialchars($j["nama_kelas"]); ?>:
<?php echo $j["total"]; ?> siswa</p>
<?php } ?>
</body>
</html>