<?php 
    session_start();
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "t4_224117137"; // Ganti dengan nama database Anda

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        throw $e;
    }
?>