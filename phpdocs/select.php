<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchall(PDO::FETCH_ASSOC);
?>