<?php include_once "header.php"; ?>

<br>

<h1 align="center">Heal &amp; Rise</h1>
<p align="center" style="font-size:16px;color:#555;">Rehabilitation, Counseling &amp; Empowerment Platform</p>
<hr>


<div class="top-brands" style="background-color: white !important">
<div class="container">

<h3>Login</h3>
<p style="color:#777;">Admin, NGO, Team Member, Counselor &amp; User</p>
<div class="agile_top_brands_grids">


<div class="row" style="width:50% !important; margin:0 auto !important">
<div class="col-md-12">
	

<?php 

if(isset($_POST['submit'])){

$email  	= $_POST['email'];
$password  	= $_POST['password'];

$email 		= $db->real_escape_string($email);
$password 	= $db->real_escape_string($password);

$query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' AND status='Confirm'  LIMIT 1";


$result 	= $db->query($query);
$num_row 	= $result->num_rows;

if($num_row == 0){


echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>Wrong Email, Password OR Registration Request not approved</p>";



}else{

$row = $result->fetch_assoc();

$row_id 		= $row['id'];
$row_role 		= $row['role'];

$name    = $row['name'];
$email     = $row['email'];
$mobile     = $row['contact'];


$_SESSION['id'] 	= $row_id;
$_SESSION['role'] 	= $row_role;

$_SESSION['name']   = $name;
$_SESSION['email']   = $email;
$_SESSION['contact']   = $mobile;

header("Location: backend/index.php"); 
    

  }



}


?>



<form method="post" action="login.php">


<div class="form-group">
<label>Email</label>
<input class="form-control" type="email" name="email" required>
</div>


<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" required>
</div>


<input type="submit" value="Login" name="submit" class="btn btn-success btn-block">

 <a href="register.php" class="btn btn-info btn-block">Register</a>
 


</form>




</div>	
</div>



<div class="clearfix"> </div>
</div>
</div>
</div>



<?php include_once "footer.php"; ?>
