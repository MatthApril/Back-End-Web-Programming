<?php 
    session_start();

    $db = "t3_224117137";
    $host = "localhost";
    $usn = "root";
    $pass = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db;", $usn, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // echo "Connected successfully";
    } catch (PDOException $e) {
        throw $$e;
    }
?>