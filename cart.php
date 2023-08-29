<?php
include('./database/connect.php');
?>
<?php
ob_start();
// include header.php file
include('header.php');
?>
<style>.cart-img{
width: 80px;
height: 80px;
}</style>
<div class="container">
<div class="row">
<!-- form starts here -->
<form action="" method="post">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Product Title</th>
                <th>Product image</th>
                <th>Update Qty</th>
                <th>Current Qty</th>
                <th>Price</th>
                <th>Remove</th>
                <th>Operations</th>
                <th>Total: $</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $conn;
            $get_ip_add = getIPAddress();
            $total_price = 0;

            $check_cart_query = "SELECT * FROM `cart_details` WHERE ip_address = '$get_ip_add'";
            $check_cart_result = mysqli_query($conn, $check_cart_query);
            $existing_items = mysqli_num_rows($check_cart_result);

            if ($existing_items > 0) {
                if (isset($_POST['update_cart'])) {
                    foreach ($_POST['qty'] as $index => $quantity) {
                        $item_id = $_POST['item_id'][$index];
                        $update_cart = "UPDATE `cart_details` SET quantity = $quantity WHERE ip_address = '$get_ip_add' AND item_id = $item_id";
                        $result_item_quantity = mysqli_query($conn, $update_cart);
                    }
                    // Redirecționează către pagina cart.php
                    header("Location: cart.php");
                    exit;
                }

                $cart_query = "SELECT * FROM `cart_details` WHERE ip_address = '$get_ip_add'";
                $result = mysqli_query($conn, $cart_query);

                while ($row = mysqli_fetch_array($result)) {
                    $item_id = $row['item_id'];
                    $currentquantity = $row['quantity'];
                    $select_item = "SELECT * FROM `product` WHERE item_id = '$item_id'";
                    $result_item = mysqli_query($conn, $select_item);

                    while ($row_item_price = mysqli_fetch_array($result_item)) {
                        $item_price = $row_item_price['item_price'];
                        $price_table = $row_item_price['item_price'];
                        $item_name = $row_item_price['item_name'];
                        $item_image1 = $row_item_price['item_image1'];
                        $item_values = $item_price * $currentquantity;
                        $total_price += $item_values;
                        ?>
                        <tr>
                            <td><?php echo $item_name ?></td>
                            <td><img src="./admin/<?php echo $item_image1 ?>" alt="" class="cart-img"></td>
                            <td><input type="text" name="qty[]" class="form-input w-50" value="<?php echo $currentquantity ?>"> </td>
                            <input type="hidden" name="item_id[]" value="<?php echo $item_id ?>">
                            <td><?php echo $currentquantity ?></td>
                            <td><?php echo $price_table ?></td>
                            <td><input type="checkbox" name="removeitem[]" value="<?php echo $item_id ?>"> </td>
                            <td>
                                <input type="submit" value="Update" class="bg-dark text-light border-0 px-3 mx-3" name="update_cart">
                                <input type="submit" value="Remove" class="bg-danger text-light border-0 px-3 mx-3" name="remove_cart">
                            </td>
                            <td><?php echo $item_values ?></td>
                        </tr>
            <?php
                    }
                }
            } else {
                echo "<tr><td colspan='8'>No items in cart.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="d-flex mb-5">
        <h4 class="px-3">Subtotal: $<strong><?php echo $total_price ?></strong> </h4>
        <button class="bg-dark  border-0 px-3 mx-3"><a href="index.php" class="text-light">Continue Shopping</a></button>
        <button class="bg-danger text-light border-0 px-3 mx-3"><a href="checkout.php" class="text-light">Checkout</a></button>
    </div>
</form>
<!-- form ends here -->

<?php
// function to remove item
function remove_cart_item() {
    global $conn;
    if (isset($_POST['remove_cart'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
            $delete_query = "DELETE FROM `cart_details` WHERE item_id = $remove_id";
            $run_delete = mysqli_query($conn, $delete_query);
        }
        return "<script>window.open('cart.php', '_self')</script>";
    }
}

$remove_item = remove_cart_item();
echo $remove_item;


?>

</div>
</div>

<?php
// include footer.php file
include('footer.php');
?>
