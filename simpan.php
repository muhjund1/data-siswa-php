<?php
require "koneksi.php";
$nama = trim($_POST["nama"] ?? "");
$email = trim($_POST["email"] ?? "");
$alamat = trim($_POST["alamat"] ?? "");
$kelas_id = filter_var(
$_POST["kelas_id"] ?? null,
FILTER_VALIDATE_INT
);
if ($nama === "" || $alamat === ""
|| !filter_var($email, FILTER_VALIDATE_EMAIL)
|| $kelas_id === false || $kelas_id === null) {
die("Input tidak valid. Kembali dan periksa isian.");
}
$stmt = $pdo->prepare(
"INSERT INTO siswa (nama, email, alamat, kelas_id)
VALUES (:nama, :email, :alamat, :kelas_id)"
);
$stmt->execute([
"nama" => $nama,
"email" => $email,
"alamat" => $alamat,
"kelas_id" => $kelas_id
]);
header("Location: index.php");
exit;