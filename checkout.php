<?php

if(isset($_SESSION['username'])){
    header("Location: payment.php");
    exit();
    
}

?>


<div class="row px-1">
    <div class="col-md-12">
        <div class="row">
            <?php
            if(!isset($_SESSION['username'])){
                include('user_login.php');
            } else {
                include('payment.php');
            }
            ?>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
