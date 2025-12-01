<?php
//$host = "sql100.infinityfree.com"; 
//$dbname = "if0_39899559_tont";
//$dbusername = "if0_39899559"; // root
//$dbpassword = "B56VvfK38RpqV"; // empty

$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/configs.ini', true)['db'];

$host = $config['host'];
$dbname = $config['dbname'];
$dbusername = $config['username']; // root
$dbpassword = $config['password']; // empty

$dsn = "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4";

try{
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "connection failed: " . $e->getMessage();
}

