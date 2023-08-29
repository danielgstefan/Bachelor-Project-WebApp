<?php
include('./database/connect.php');
?>
<?php
ob_start();
// include header.php file
include('header.php');
?>
<?php
//include banner area
//include('Template/_banner-area.php');
?>
<style>
   
    .description {
  float: right;
  margin-top: 10px;
}
</style>
<body>
    


<?php
view_details();
get_unique_cat();
get_unique_brands();
?>




</body>
<?php
// include footer.php file
include('footer.php');
?>