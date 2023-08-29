<?php
include('./database/connect.php');
?>
<?php
ob_start();
// include header.php file
include('header.php');
?>

<div class="row px-1">
<div class="col-md-10">
<div class="row">
<?php
search_product();
get_unique_cat();
get_unique_brands();
?>
</div>
</div>
<div class="col-md-2 bg-dark p-0">
<ul class="navbar-nav me-auto text-center">
<li class="li nav-item color-primary-bg ">
    <a href="#" class="nav-link text-light font-size-20">Brands</a>
</li>
<?php
getbrands();
?>
</ul>
<ul class="navbar-nav me-auto text-center ">
<li class="li nav-item color-primary-bg ">
    <a href="#" class="nav-link text-light font-size-20">Categories</a>
</li>
<?php
getcategory();
?>
</ul>
</div>
</div>
<?php
// include footer.php file
include('footer.php');
?>