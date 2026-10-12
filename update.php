<?php
require "koneksi.php";
$id = filter_var($_POST["id"] ?? null, FILTER_VALIDATE_INT);
$kelas_id = filter_var(
$_POST["kelas_id"] ?? null, FILTER_VALIDATE_INT
);
$nama = trim($_POST["nama"] ?? "");
$email = trim($_POST["email"] ?? "");
$alamat = trim($_POST["alamat"] ?? "");
if (!$id || !$kelas_id || $nama === "" || $alamat === ""
|| !filter_var($email, FILTER_VALIDATE_EMAIL)) {
die("Data edit tidak valid.");
}
$stmt = $pdo->prepare(
"UPDATE siswa SET nama = :nama, email = :email, alamat = :alamat,
kelas_id = :kelas_id WHERE id = :id"
);
$stmt->execute([
"nama" => $nama, "email" => $email, "alamat" => $alamat,
"kelas_id" => $kelas_id, "id" => $id
]);
header("Location: index.php");
exit;