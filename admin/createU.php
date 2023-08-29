<?php
// Verificați dacă formularul a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preluați valorile din formular
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $pnumber = $_POST["pnumber"];
    $address = $_POST["address"];
    $birthdate = $_POST["birthdate"];

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

    // Operație de creare (Create) - adăugați utilizatorul în baza de date
    $sql = "INSERT INTO user (first_name, last_name, email, password, pnumber, address, birthdate) 
            VALUES ('$first_name', '$last_name', '$email', '$password', '$pnumber', '$address', '$birthdate')";

    if ($conn->query($sql) === TRUE) {
        // Redirecționați utilizatorul către raportul utilizatorilor
        header('Location: reportU.php');
        exit();
    } else {
        echo "Eroare la adăugarea utilizatorului: " . $conn->error;
    }

    // Închideți conexiunea
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adăugare Utilizator</title>
    <!-- Incluziunea fișierelor CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Adăugare Utilizator</h2>

        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="mt-4">
            <div class="form-group">
                <label>Prenume:</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nume:</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Parolă:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Număr de telefon:</label>
                <input type="text" name="pnumber" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Adresă:</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Data nașterii:</label>
                <input type="date" name="birthdate" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Adăugare</button>
        </form>
    </div>

    <!-- Incluziunea fișierelor JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
