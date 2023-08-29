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

// Funcția pentru obținerea tuturor brandurilor
function getBrands() {
    global $conn;
    $brands = array();

    $sql = "SELECT * FROM brands";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $brands[] = $row;
        }
    }

    return $brands;
}

// Adăugarea unui brand nou
if (isset($_POST['add_brand'])) {
    $brand_title = $_POST['brand_title'];

    $sql = "INSERT INTO brands (brand_title) VALUES ('$brand_title')";
    if ($conn->query($sql) === TRUE) {

        header("Location: index.php?viewbrands");
        exit();
    } else {
        echo "Eroare la adăugarea brandului: " . $conn->error;
    }
}

// Actualizarea unui brand existent
if (isset($_POST['update_brand'])) {
    $brand_id = $_POST['brand_id'];
    $brand_title = $_POST['brand_title'];

    $sql = "UPDATE brands SET brand_title='$brand_title' WHERE brand_id=$brand_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?viewbrands");
        exit();
    } else {
        echo "Eroare la actualizarea brandului: " . $conn->error;
    }
}

// Ștergerea unui brand existent
if (isset($_POST['delete_brand'])) {
    $brand_id = $_POST['brand_id'];

    $sql = "DELETE FROM brands WHERE brand_id=$brand_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?viewbrands");
        exit();
    } else {
        echo "Eroare la ștergerea brandului: " . $conn->error;
    }
}

// Obținerea brandurilor existente
$brands = getBrands();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Raport Branduri</title>
    <!-- Incluziunea fișierelor CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Raport Branduri</h2>

        <!-- Formular pentru adăugarea unui brand -->
        <h3 class="mt-4">Adăugare Brand</h3>
        <form method="post">
            <div class="form-group">
                <label for="brand_title">Titlu Brand:</label>
                <input type="text" class="form-control" id="brand_title" name="brand_title" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_brand">Adăugare</button>
        </form>

        <!-- Tabel pentru afișarea brandurilor existente -->
        <h3 class="mt-4">Branduri Existente</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titlu Brand</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($brands as $brand) { ?>
                    <tr>
                        <td><?php echo $brand['brand_id']; ?></td>
                        <td><?php echo $brand['brand_title']; ?></td>
                        <td>
                            <!-- Modale pentru editare și ștergere brand -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?php echo $brand['brand_id']; ?>">Editare</button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $brand['brand_id']; ?>">Ștergere</button>
                        </td>
                    </tr>

                    <!-- Modal pentru editarea brandului -->
                    <div class="modal fade" id="editModal<?php echo $brand['brand_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $brand['brand_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?php echo $brand['brand_id']; ?>">Editare Brand</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="edit_brand_title">Titlu Brand:</label>
                                            <input type="text" class="form-control" id="edit_brand_title" name="brand_title" value="<?php echo $brand['brand_title']; ?>" required>
                                        </div>
                                        <input type="hidden" name="brand_id" value="<?php echo $brand['brand_id']; ?>">
                                        <button type="submit" class="btn btn-primary" name="update_brand">Actualizare</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anulare</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal pentru ștergerea brandului -->
                    <div class="modal fade" id="deleteModal<?php echo $brand['brand_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $brand['brand_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel<?php echo $brand['brand_id']; ?>">Ștergere Brand</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Sigur doriți să ștergeți brandul "<?php echo $brand['brand_title']; ?>"?
                                </div>
                                <div class="modal-footer">
                                    <form method="post">
                                        <input type="hidden" name="brand_id" value="<?php echo $brand['brand_id']; ?>">
                                        <button type="submit" class="btn btn-danger" name="delete_brand">Ștergere</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anulare</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Incluziunea fișierelor JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
