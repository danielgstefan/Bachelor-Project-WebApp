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

    // Verificați dacă a fost trimis un formular de editare
    if(isset($_POST['editUser'])) {
        // Obțineți datele actualizate din formular
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pnumber = $_POST['pnumber'];
        $address = $_POST['address'];

        // Actualizați înregistrarea utilizatorului în baza de date
        $sql = "UPDATE user SET username='$username', first_name='$first_name', last_name='$last_name', email='$email', password='$password', pnumber='$pnumber', address='$address' WHERE user_id=$user_id";

        if ($conn->query($sql) === TRUE) {
            // Redirecționați către pagina de raport a utilizatorilor
            header("Location: index.php?viewusers");
            exit();
        } else {
            echo "Eroare la actualizarea utilizatorului: " . $conn->error;
        }
    }

    // Obțineți datele utilizatorului din baza de date
    $sql = "SELECT * FROM user WHERE user_id=$user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $password = $row['password'];
        $pnumber = $row['pnumber'];
        $address = $row['address'];
    } else {
        echo "Utilizatorul nu există.";
        exit();
    }

    // Închideți conexiunea la baza de date
    $conn->close();
} else {
    echo "ID utilizator lipsă.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editare Utilizator</title>
    <!-- Incluziunea fișierelor CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Editare Utilizator</h2>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Nume utilizator:</label>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="form-group">
                <label for="first_name">Prenume:</label>
                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Nume:</label>
                <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Parolă:</label>
                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" required>
            </div>
            <div class="form-group">
                <label for="pnumber">Număr telefon:</label>
                <input type="text" class="form-control" name="pnumber" value="<?php echo $pnumber; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Adresă:</label>
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" required>
            </div>
            <button type="submit" name="editUser" class="btn btn-primary">Actualizare Utilizator</button>
        </form>
    </div>

    <!-- Incluziunea fișierelor JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
