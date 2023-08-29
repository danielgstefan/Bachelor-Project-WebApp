<?php
// Verificați dacă a fost trimis un request de tip POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificați dacă există un parametru payment_id în request
    if (isset($_POST['payment_id'])) {
        // Preluați id-ul plății din parametrul payment_id
        $payment_id = $_POST['payment_id'];

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

        // Ștergeți înregistrarea din tabela "payments" cu id-ul specificat
        $delete_query = "DELETE FROM payments WHERE payment_id = $payment_id";
        $result = $conn->query($delete_query);

        if ($result) {
            // Ștergerea a fost realizată cu succes
            echo "<script>alert('Plata a fost stearsa!')</script>"; 
            echo "<script>window.open('index.php?viewpayments','_self')</script>"; 
        } else {
            // A apărut o eroare la ștergerea plății
            echo "A apărut o eroare la ștergerea plății: " . $conn->error;
            echo "<script>window.open('index.php?viewpayments','_self')</script>"; 
        }

        // Închideți conexiunea la baza de date
        $conn->close();
    } else {
        // Parametrul payment_id lipsește din request
        echo "Eroare: Parametrul payment_id lipsește din request!";
    }
} else {
    // Accesul la fișierul deletePayment.php se face doar prin metoda POST
    echo "Eroare: Accesul nepermis!";
}
?>
