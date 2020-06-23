<?php

// connect to DB
$servername = "localhost";
$username = "test";
$password = "test";

try {
  $conn = new PDO("mysql:host=$servername;dbname=chat", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

