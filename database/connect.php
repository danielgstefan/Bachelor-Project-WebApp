<?php
// Configurarea conexiunii la baza de date
$servername = 'localhost';
            $username = 'root';
            $password = '';
            $database = "mogds";

// Crearea conexiunii
$conn = new mysqli($servername, $username, $password, $database);

// Verificați conexiunea
if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}