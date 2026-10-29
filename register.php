<?php include_once "header.php"; ?>




<div class="banner">
<div class="w3l_banner_nav_left">



</div>




<div class="top-brands" style="background-color: white !important">
<div class="container">

<h3>Create an Account</h3>
<p style="color:#777;">Your personal information is kept strictly confidential and is only accessed by verified staff.</p>
<div class="agile_top_brands_grids">


<div class="row" style="width:60% !important; margin:0 auto !important">
<div class="col-md-12">
	

<?php 



if(isset($_POST['submit'])){

$email = $db->real_escape_string($_POST['email']);

$check = "SELECT email FROM users WHERE email = '{$email}'";


$result = $db->query($check);
$rows = $result->num_rows;
if($rows > 0){


echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>Email already Taken.</p>";

}else{




$name 			= $db->real_escape_string($_POST['name']);
$password 		= $db->real_escape_string($_POST['password']);
$con_password 	= $db->real_escape_string($_POST['con_password']);
$phone 			= $db->real_escape_string($_POST['phone']);
$type 			= $db->real_escape_string($_POST['type']);
$city 			= $db->real_escape_string($_POST['city']);

$gender 		= isset($_POST['gender']) ? $db->real_escape_string($_POST['gender']) : '';
$age 			= isset($_POST['age']) ? $db->real_escape_string($_POST['age']) : '';
$cnic 			= isset($_POST['cnic']) ? $db->real_escape_string($_POST['cnic']) : '';
$address 		= isset($_POST['address']) ? $db->real_escape_string($_POST['address']) : '';
$problem_category = isset($_POST['problem_category']) ? $db->real_escape_string($_POST['problem_category']) : '';
$problem_details  = isset($_POST['problem_details']) ? $db->real_escape_string($_POST['problem_details']) : '';
$ngo_name 		= isset($_POST['ngo_name']) ? $db->real_escape_string($_POST['ngo_name']) : '';
$consent 		= isset($_POST['consent']) ? 'Yes' : 'No';


if($consent != 'Yes'){

echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>You must accept the Privacy Policy to register.</p>";

}elseif($password === $con_password){


$reg_query = "INSERT INTO users 
	(name,email,password,contact,role,city,gender,age,cnic,address,problem_category,problem_details,ngo_name,privacy_consent,is_private,status) 
	VALUES 
	('{$name}','{$email}','{$password}','{$phone}','{$type}','{$city}','{$gender}','{$age}','{$cnic}','{$address}','{$problem_category}','{$problem_details}','{$ngo_name}','{$consent}','Yes','Pending')";


$result_reg = $db->query($reg_query);

if($result_reg){

echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-success'>Account created. Your details will be verified by the Admin before you can log in.</p>";

}else{

	die($db->error);
}


}else{


echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>Passwords Not Matched.</p>";



}


} 



}



?>



<form method="post" action="register.php">


<div class="form-group">
<label>Full Name</label>
<input class="form-control" type="text" name="name" required>
</div>


<div class="form-group">
<label>Email</label>
<input class="form-control" type="email" name="email" required>
</div>


<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" required>
</div>


<div class="form-group">
<label>Confirm Password</label>
<input class="form-control" type="password" name="con_password" value="" required>
</div>


<div class="form-group">
<label>Phone</label>
<input class="form-control" type="text" name="phone" required>
</div>


<div class="form-group">
<label>City</label>
<input class="form-control" type="text" name="city" required>
</div>


<div class="form-group">
<label>Register As</label>
<select class="form-control" name="type" id="type" required onchange="toggleFields()">
	<option value="" selected>Choose Type</option>
	<option value="user">User (Seeking Help)</option>
	<option value="NGO">NGO</option>
</select>
</div>


<!-- NGO only -->
<div id="ngo_fields" style="display:none;">
	<div class="form-group">
		<label>NGO / Organization Name</label>
		<input class="form-control" type="text" name="ngo_name">
	</div>
</div>


<!-- User only -->
<div id="user_fields" style="display:none;">

	<div class="form-group">
		<label>Gender</label>
		<select class="form-control" name="gender">
			<option value="">Choose</option>
			<option value="Male">Male</option>
			<option value="Female">Female</option>
			<option value="Other">Other</option>
		</select>
	</div>

	<div class="form-group">
		<label>Age</label>
		<input class="form-control" type="number" name="age">
	</div>

	<div class="form-group">
		<label>CNIC</label>
		<input class="form-control" type="text" name="cnic" placeholder="xxxxx-xxxxxxx-x">
	</div>

	<div class="form-group">
		<label>Address</label>
		<textarea class="form-control" name="address"></textarea>
	</div>

	<div class="form-group">
		<label>Problem Category</label>
		<select class="form-control" name="problem_category">
			<option value="">Choose</option>
			<option value="Psychological Support">Psychological Support</option>
			<option value="Addiction Recovery">Addiction Recovery</option>
			<option value="Domestic Abuse">Domestic Abuse</option>
			<option value="Financial Hardship">Financial Hardship</option>
			<option value="Skill Development">Skill Development</option>
			<option value="Other">Other</option>
		</select>
	</div>

	<div class="form-group">
		<label>Brief Details of Your Situation</label>
		<textarea class="form-control" name="problem_details"></textarea>
	</div>

</div>


<div class="form-group" style="border:1px solid #ddd;padding:10px;border-radius:4px;">
	<label>
		<input type="checkbox" name="consent" value="Yes" required>
		I agree to the <b>Privacy Policy</b>. My information will remain confidential and will only be shared with verified NGOs and staff assigned to my case.
	</label>
</div>


<input type="submit" value="Register" name="submit" class="btn btn-success btn-block">

			<a href="index.php" class="btn btn-info btn-block">Login</a>


</form>



<script type="text/javascript">
function toggleFields(){
	var t = document.getElementById('type').value;
	document.getElementById('ngo_fields').style.display  = (t == 'NGO')  ? 'block' : 'none';
	document.getElementById('user_fields').style.display = (t == 'user') ? 'block' : 'none';
}
</script>


</div>	
</div>



<div class="clearfix"> </div>
</div>
</div>
</div>



<?php include_once "footer.php"; ?>
