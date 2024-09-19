<?php
session_start();
try {
    $con = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=user_db", "eudald", "eudald24");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit; 
}?>

