<?php
// Verificați dacă este specificat un ID de produs în parametrul URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php?viewproducts');
    exit();
}

// Preluați ID-ul produsului din parametrul URL
$item_id = $_GET['id'];

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

// Operație de ștergere (Delete) - ștergeți produsul din baza de date
$sql = "DELETE FROM product WHERE item_id = '$item_id'";

if ($conn->query($sql) === TRUE) {
    // Redirecționați utilizatorul către raportul produselor
    header('Location: index.php?viewproducts');
    exit();
} else {
    echo "Eroare la ștergerea produsului: " . $conn->error;
}

// Închideți conexiunea
$conn->close();
?>
