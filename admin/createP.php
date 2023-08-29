<?php
// Verificați dacă formularul a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Preluați valorile din formular
    $item_name = $_POST["item_name"];
    $item_price = $_POST["item_price"];
    $item_image1 = "images/" . $_FILES["item_image1"]["name"]; // Numele fișierului selectat de utilizator
    $item_image2 = "images/" . $_FILES["item_image2"]["name"]; // Numele fișierului selectat de utilizator
    $item_image3 = "images/" . $_FILES["item_image3"]["name"]; // Numele fișierului selectat de utilizator
    $brand_id = $_POST["brand_id"];
    $category_id = $_POST["category_id"];
    $item_description = $_POST["item_description"];
    $item_key = $_POST["item_key"];

    // Încărcați fișierul imagine în directorul dorit (de exemplu, "images/")
    $target_directory = "./images/";
    $target_file = $target_directory . basename($_FILES["item_image"]["name"]);
    move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);

    $target_directory = "./images/";
    $target_file = $target_directory . basename($_FILES["item_image2"]["name"]);
    move_uploaded_file($_FILES["item_image2"]["tmp_name"], $target_file);

    $target_directory = "./images/";
    $target_file = $target_directory . basename($_FILES["item_image3"]["name"]);
    move_uploaded_file($_FILES["item_image3"]["tmp_name"], $target_file);

    // Operație de inserare (Create) - adăugați produsul în baza de date
    $sql = "INSERT INTO product (item_name, item_price, item_image1, item_description, item_image2, item_image3, brand_id, category_id, item_key) VALUES ('$item_name', '$item_price', '$item_image1', '$item_description', '$item_image2', '$item_image3', '$brand_id', '$category_id', '$item_key')";

    if ($conn->query($sql) === TRUE) {
        // Redirecționați utilizatorul către raportul produselor
        header('Location: index.php?viewproducts');
        exit();
    } else {
        echo "Eroare la adăugarea produsului: " . $conn->error;
    }

    // Închideți conexiunea
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adăugare Produs</title>
    <!-- Incluziunea fișierelor CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Adăugare Produs</h2>

        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="mt-4" enctype="multipart/form-data">
            <div class="form-group">
                <label>Brand:</label>
                <select name="brand_id" class="form-control">
                    <option value="">Selectați un brand</option>
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

                    // Interogare pentru selectarea categoriilor
                    $select_query = "SELECT * FROM brands";
                    $result_query = mysqli_query($conn, $select_query);

                    // Generați opțiuni pentru fiecare categorie
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }

                    // Închideți conexiunea
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Categorie:</label>
                <select name="category_id" class="form-control">
                    <option value="">Selectați o categorie</option>
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

                    // Interogare pentru selectarea categoriilor
                    $select_query = "SELECT * FROM categories";
                    $result_query = mysqli_query($conn, $select_query);

                    // Generați opțiuni pentru fiecare categorie
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }

                    // Închideți conexiunea
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Nume:</label>
                <input type="text" name="item_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Preț:</label>
                <input type="number" name="item_price" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Imagine 1:</label>
                <input type="file" name="item_image1" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label>Imagine 2:</label>
                <input type="file" name="item_image2" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label>Imagine 3:</label>
                <input type="file" name="item_image3" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label>Key:</label>
                <input type="text" name="item_key" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Descriere:</label>
                <textarea name="item_description" class="form-control" rows="5" required></textarea>
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
