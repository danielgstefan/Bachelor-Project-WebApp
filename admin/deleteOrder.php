<?php
// Verificați dacă a fost furnizat un ID de comandă valid prin metoda GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
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

    // Prevenirea atacurilor de tip SQL Injection utilizând declarații pregătite
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $_GET['id']);

    if ($stmt->execute()) {
        // Ștergerea a avut succes
        echo "<script>alert('Comanda a fost ștearsă cu succes!'); window.location.href = 'index.php?vieworders';</script>";
        exit();
    } else {
        // A apărut o eroare la ștergere
        echo "<script>alert('Eroare la ștergerea comenzii. Vă rugăm să încercați din nou!'); window.location.href = 'index.php?vieworders';</script>";
        exit();
    }
} else {
    // ID de comandă lipsă sau invalid
    echo "<script>alert('ID de comandă invalid!'); window.location.href = 'index.php?vieworders';</script>";
    exit();
}
?>
