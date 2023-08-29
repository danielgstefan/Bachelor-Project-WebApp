<h3 class="mb-4 text-center">Delete Account</h3>
<form action="" method="post" class="mt-5">
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto text-danger" name="delete" value="Delete Account">
    </div>
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Cancel">
    </div>
</form>

<?php
$username_session = $_SESSION['username'];

if (isset($_POST['delete'])) {
    $delete_query = "DELETE FROM `user` WHERE username='$username_session'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        session_destroy();
        echo "<script> alert('Account Deleted successfully')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}

if (isset($_POST['dont_delete'])) {
    echo "<script>window.open('profile.php','_self')</script>";
}
?>
