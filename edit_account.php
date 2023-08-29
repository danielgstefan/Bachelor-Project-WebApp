<?php
if(isset($_GET['edit_account'])){
$user_session_name=$_SESSION['username'];
$select_query="Select * from `user` where username='$user_session_name'";
$result_query=mysqli_query($conn, $select_query);
$row_fetch=mysqli_fetch_assoc($result_query);
$user_id=$row_fetch['user_id'];
$first_name=$row_fetch['first_name'];
$last_name=$row_fetch['last_name'];
$username=$row_fetch['username'];
$email=$row_fetch['email'];
$address=$row_fetch['address'];
$pnumber=$row_fetch['pnumber'];
}
if(isset($_POST['user_update'])){
    $update_id=$user_id;
    $first_name=$_POST['user_first'];
$last_name=$_POST['user_last'];
$username=$_POST['user_username'];
$email=$_POST['user_email'];
$address=$_POST['user_address'];
$pnumber=$_POST['user_mobile'];
$user_image=$_FILES['user_image']['name'];
$user_image_tmp=$_FILES['user_image']['tmp_name'];
move_uploaded_file($user_image_tmp,"admin/images/$user_image");

$update_data="update `user` set first_name='$first_name',last_name='$last_name',username='$username',email='$email',address='$address',pnumber='$pnumber',user_image='$user_image' where user_id=$update_id";
$result_query_update=mysqli_query($conn, $update_data);
if($result_query_update){
    echo "<script>alert ('Data updated successfully') </script>";
    echo "<script>window.open ('profile.php','_self') </script>";
}
}



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>
.profile_img_edit{
    height: 200px;
    width: 200px;
}

</style>  
</head>
  <body>
<h3 class="text-center text-success mb-4 mt-3">Edit Account</h3>
<form action="" method="post" enctype="multipart/form-data" class="text-center">
<div class="form-outline mb-4">
<input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>"  name="user_username">
</div>
<div class="form-outline mb-4">
<input type="email" class="form-control w-50 m-auto" value="<?php echo $email ?>" name="user_email">
</div>
<div class="form-outline mb-4">
<input type="text" class="form-control w-50 m-auto" value="<?php echo $first_name ?>" name="user_first">
</div>
<div class="form-outline mb-4">
<input type="text" class="form-control w-50 m-auto" value="<?php echo $last_name ?>" name="user_last">
</div>
<div class="form-outline mb-4">
<input type="file" class="form-control w-50 m-auto" name="user_image">
<img src="admin/images/<?php echo $user_image?>" class="profile_img_edit">
 </div>
<div class="form-outline mb-4">
<input type="text" class="form-control w-50 m-auto" value="<?php echo $pnumber ?>" name="user_mobile">
 </div>
<div class="form-outline mb-4">
<input type="text" class="form-control w-50 m-auto" value="<?php echo $address ?>" name="user_address">
 </div>
 <input type="submit" value="Update" class="color-primary-bg py-2 px-3 border-0" name="user_update">
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>