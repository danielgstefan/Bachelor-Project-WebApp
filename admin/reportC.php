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

// Funcția pentru adăugarea unei categorii
function addCategory($categoryTitle) {
    global $conn;

    $insertQuery = "INSERT INTO categories (category_title) VALUES ('$categoryTitle')";
    $result = $conn->query($insertQuery);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Funcția pentru obținerea tuturor categoriilor
function getCategories() {
    global $conn;

    $selectQuery = "SELECT * FROM categories";
    $result = $conn->query($selectQuery);

    $categories = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    return $categories;
}

// Funcția pentru actualizarea unei categorii
function updateCategory($categoryId, $categoryTitle) {
    global $conn;

    $updateQuery = "UPDATE categories SET category_title = '$categoryTitle' WHERE category_id = $categoryId";
    $result = $conn->query($updateQuery);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Funcția pentru ștergerea unei categorii
function deleteCategory($categoryId) {
    global $conn;

    $deleteQuery = "DELETE FROM categories WHERE category_id = $categoryId";
    $result = $conn->query($deleteQuery);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Verificarea dacă s-a trimis formularul pentru adăugarea unei categorii
if (isset($_POST['add_category'])) {
    $categoryTitle = $_POST['category_title'];

    if (addCategory($categoryTitle)) {
        echo "Categoria a fost adăugată cu succes.";
    } else {
        echo "Eroare la adăugarea categoriei.";
    }
}

// Verificarea dacă s-a trimis formularul pentru actualizarea unei categorii
if (isset($_POST['update_category'])) {
    $categoryId = $_POST['category_id'];
    $categoryTitle = $_POST['category_title'];

    if (updateCategory($categoryId, $categoryTitle)) {
        echo "Categoria a fost actualizată cu succes.";
    } else {
        echo "Eroare la actualizarea categoriei.";
    }
}

// Verificarea dacă s-a trimis formularul pentru ștergerea unei categorii
if (isset($_POST['delete_category'])) {
    $categoryId = $_POST['category_id'];

    if (deleteCategory($categoryId)) {
        echo "Categoria a fost ștearsă cu succes.";
    } else {
        echo "Eroare la ștergerea categoriei.";
    }
}

// Obținerea categoriilor existente
$categories = getCategories();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Raport Categorii</title>
    <!-- Incluziunea fișierelor CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Raport Categorii</h2>

        <!-- Formular pentru adăugarea unei categorii -->
        <h3 class="mt-4">Adăugare Categorie</h3>
        <form method="post">
            <div class="form-group">
                <label for="category_title">Titlu Categorie:</label>
                <input type="text" class="form-control" id="category_title" name="category_title" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_category">Adăugare</button>
        </form>

        <!-- Tabel cu categoriile existente -->
        <h3 class="mt-4">Categorii Existente</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titlu Categorie</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) { ?>
                    <tr>
                        <td><?php echo $category['category_id']; ?></td>
                        <td><?php echo $category['category_title']; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?php echo $category['category_id']; ?>">Editare</button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $category['category_id']; ?>">Ștergere</button>
                        </td>
                    </tr>

                    <!-- Modal pentru editarea categoriei -->
                    <div class="modal fade" id="editModal<?php echo $category['category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $category['category_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?php echo $category['category_id']; ?>">Editare Categorie</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                                        <div class="form-group">
                                            <label for="edit_category_title<?php echo $category['category_id']; ?>">Titlu Categorie:</label>
                                            <input type="text" class="form-control" id="edit_category_title<?php echo $category['category_id']; ?>" name="category_title" value="<?php echo $category['category_title']; ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="update_category">Actualizare</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal pentru ștergerea categoriei -->
                    <div class="modal fade" id="deleteModal<?php echo $category['category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $category['category_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel<?php echo $category['category_id']; ?>">Ștergere Categorie</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Sigur doriți să ștergeți categoria "<?php echo $category['category_title']; ?>"?
                                </div>
                                <div class="modal-footer">
                                    <form method="post">
                                        <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                                        <button type="submit" class="btn btn-danger" name="delete_category">Ștergere</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anulare</button>
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
