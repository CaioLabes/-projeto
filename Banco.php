<?php
$servidor = "localhost:3307";
$userbanco = "root";
$senhabanco = "";
$nomebanco = "projeto_php";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$nomebanco", $userbanco, $senhabanco);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
