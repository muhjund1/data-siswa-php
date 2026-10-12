<?php
require "koneksi.php";
$id = filter_var($_POST["id"] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
die("ID tidak valid.");
}
$stmt = $pdo->prepare("DELETE FROM siswa WHERE id = :id");
$stmt->execute(["id" => $id]);
header("Location: index.php");
exit;