<!DOCTYPE html>
<html>
<head>
    <title>Raport Plăți</title>
    <!-- Incluziunea fișierelor CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Raport Plăți</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Order ID</th>
                    <th>Invoice Number</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Configurarea conexiunii la baza de date
                $servername = 'localhost';
                $username = 'root';
                $password = '';
                $database = "mogds";

                // Crearea conexiunii
                $conn = new mysqli($servername, $username, $password, $database);

                // Verificarea conexiunii
                if ($conn->connect_error) {
                    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
                }

                // Operație de citire (Read) - obținerea plăților din baza de date
                $sql = "SELECT * FROM payments";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['payment_id'] . "</td>";
                        echo "<td>" . $row['order_id'] . "</td>";
                        echo "<td>" . $row['invoice_number'] . "</td>";
                        echo "<td>" . $row['amount'] . "</td>";
                        echo "<td>" . $row['payment_mode'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>
                                <form method='POST' action='deletePayment.php'>
                                    <input type='hidden' name='payment_id' value='" . $row['payment_id'] . "'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nu există plăți în baza de date.</td></tr>";
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
