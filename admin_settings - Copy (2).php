<?php include_once "header.php"; ?>

<div id="wrapper">

<!----->

<?php if($user_role == 'admin'){ ?>



<?php include_once "admin_sidebar.php"; ?>


<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">

<div class="content-top">


<div class="col-md-4">
<div class="content-top-1">


<p class="alert">Update Your Info</p>

</div>
</div>



<div class="col-md-8 ">
<div class="content-top-1">





<?php



$sql = "SELECT * FROM users WHERE id = '{$user_id}'";
if($db->error){
$error = $db->error;
echo $error;
}

$result = $db->query($sql);
while($row = $result->fetch_assoc()){

$name = $row['name'];
$email = $row['email'];
$password = $row['password'];
$phone = $row['contact'];




}// end of while loop





?>




<form class="form-horizontal" action="admin_settings.php" method="post" enctype="multipart/form-data">

<div class="form-group">
<label class="sr-only" for="username">User Name</label>
<input type="text" name="username" placeholder="Your Name" value="<?php if(isset($name)){echo $name; } ?>" class="form-first-name form-control" id="username" autofocus>
</div>


<div class="form-group">
<label class="sr-only" for="form-email">Email</label>
<input type="email" name="email" placeholder="Your Email" class="form-email form-control" value="<?php if(isset($email)){echo $email; } ?>" id="form-email" >
</div>


<div class="form-group">
<label class="sr-only" for="form-password">Password</label>
<input type="password" name="password" placeholder="Your Password" class="form-email form-control" value="<?php if(isset($password)){echo $password; } ?>" id="form-email" >
</div>

<div class="form-group">
<label class="sr-only" for="form-password">Phone</label>
<input type="text" name="phone" placeholder="Your Number" class="form-number form-control" value="<?php if(isset($phone)){echo $phone; } ?>" id="form-email" >
</div>







<div class="form-group">
<button type="submit" name="update" class="btn btn-info">Update</button>
</div>
</form>



<?php
// This coding is for updating user profile

if(isset($_POST['update'])){

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];







$sql = "UPDATE users SET name = \"$username\", email = \"$email\", password = \"$password\", contact = \"$phone\" WHERE id = \"$user_id\"  ";
if($db->error){
$error = $db->error;
echo $error;
}
$result = $db->query($sql);
if($result){
echo "<p class='alert alert-warning'>Profile Info is Updated</p>";
}else{
die($db->error);
}


}




?>








</div>
</div>




<div class="clearfix"> </div>
</div>


<?php }else{header("Location: logout.php"); } ?>





<?php include_once "footer.php"; ?>

