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

// Operație de citire (Read) - obțineți produsele din baza de date
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Raport Produse</title>
    <!-- Incluziunea fișierelor CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Raport Produse</h2>

        <a href="createP.php" class="btn btn-primary mb-4">Adăugare Produs</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Categorie</th>
                    <th>Nume</th>
                    <th>Preț</th>
                    <th>Imagine1</th>
                    <th>Imagine2</th>
                    <th>Imagine3</th>
                    <th>Descriere</th>
                    <th>Keyword</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['item_id'] . "</td>";
                        echo "<td>" . $row['brand_id'] . "</td>";
                        echo "<td>" . $row['category_id'] . "</td>";
                        echo "<td>" . $row['item_name'] . "</td>";
                        echo "<td>" . $row['item_price'] . "</td>";
                        echo "<td><img src='" . $row['item_image1'] . "' height='50'></td>";
echo "<td><img src='" . $row['item_image2'] . "' height='50'></td>";
echo "<td><img src='" . $row['item_image3'] . "' height='50'></td>";


                        echo "<td>" . $row['item_description'] . "</td>";
                        echo "<td>" . $row['item_key'] . "</td>";
                        echo "<td>
                                <a href='editP.php?id=" . $row['item_id'] . "' class='btn btn-primary btn-sm'>Editare</a>
                                <a href='deleteP.php?id=" . $row['item_id'] . "' class='btn btn-danger btn-sm'>Ștergere</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nu există produse în baza de date.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Incluziunea fișierelor JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
