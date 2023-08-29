<?php
// Verificați dacă există un ID de utilizator în parametrii URL-ului
if(isset($_GET['id'])) {
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

    // Obțineți ID-ul utilizatorului din parametrii URL-ului
    $user_id = $_GET['id'];

    // Ștergeți înregistrarea utilizatorului din baza de date
    $sql = "DELETE FROM user WHERE user_id=$user_id";

    if ($conn->query($sql) === TRUE) {
        // Redirecționați către pagina de raport a utilizatorilor
        header("Location: index.php?viewusers");
        exit();
    } else {
        echo "Eroare la ștergerea utilizatorului: " . $conn->error;
    }

    // Închideți conexiunea la baza de date
    $conn->close();
} else {
    echo "ID utilizator lipsă.";
    exit();
}
?>
