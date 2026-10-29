<?php include_once "header.php"; ?>
<div id="wrapper">
<?php if ($user_role == 'admin') { include_once "admin_sidebar.php"; ?>

<style type="text/css"> table, th, td { text-align: center; } </style>

<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">
<div class="content-top">
<div class="col-md-12">
<div class="content-top-1">

<h3>NGO Connection &amp; Case Assignment</h3>
<p style="color:#777;">Connect verified users with a relevant NGO and assign a team member to monitor progress.</p>
<br>

<?php
/* ---- Create / assign case ---- */
if(isset($_POST['assign_submit'])){
	$uid  = (int)$_POST['user_id'];
	$ngo  = (int)$_POST['ngo_id'];
	$team = (int)$_POST['team_member_id'];
	$coun = (int)$_POST['counselor_id'];
	$cat  = $db->real_escape_string($_POST['category']);

	// avoid duplicate open case for same user
	$chk = $db->query("SELECT id FROM cases WHERE user_id='{$uid}'");
	if($chk->num_rows > 0){
		echo "<p class='alert alert-warning'>This user already has a case. Update it below.</p>";
	}else{
		$ins = "INSERT INTO cases (user_id,ngo_id,team_member_id,counselor_id,category,progress,notes)
				VALUES ('{$uid}','{$ngo}','{$team}','{$coun}','{$cat}','Assigned','Case connected to NGO by admin.')";
		if($db->query($ins)){
			echo "<p class='alert alert-success'>User successfully connected with NGO and team assigned.</p>";
		}else{ echo "<p class='alert alert-danger'>".$db->error."</p>"; }
	}
}

/* ---- Update case assignment ---- */
if(isset($_POST['update_submit'])){
	$cid  = (int)$_POST['case_id'];
	$ngo  = (int)$_POST['ngo_id'];
	$team = (int)$_POST['team_member_id'];
	$coun = (int)$_POST['counselor_id'];
	$prog = $db->real_escape_string($_POST['progress']);
	$db->query("UPDATE cases SET ngo_id='{$ngo}', team_member_id='{$team}', counselor_id='{$coun}', progress='{$prog}' WHERE id='{$cid}'");
	echo "<p class='alert alert-success'>Case updated.</p>";
}

/* ---- Delete case ---- */
if(isset($_GET['del'])){
	$cid=(int)$_GET['del'];
	$db->query("DELETE FROM cases WHERE id='{$cid}'");
	echo "<script>alert('Case deleted');window.open('cases.php','_self');</script>";
}

// Build dropdown option helpers
function options($db, $role, $selected=0){
	$out='';
	$q=$db->query("SELECT id,name,ngo_name,specialization FROM users WHERE role='{$role}' AND status='Confirm'");
	while($r=$q->fetch_assoc()){
		$label=$r['name'];
		if($role=='NGO' && $r['ngo_name']!='') $label=$r['ngo_name'];
		if(($role=='counselor'||$role=='team_member') && $r['specialization']!='') $label.=" (".$r['specialization'].")";
		$sel=($r['id']==$selected)?'selected':'';
		$out.="<option value='".$r['id']."' $sel>".$label."</option>";
	}
	return $out;
}
?>

<h4>Connect a New User</h4>
<?php
// unassigned confirmed users
$uq = $db->query("SELECT * FROM users WHERE role='user' AND status='Confirm' AND id NOT IN (SELECT user_id FROM cases)");
if($uq->num_rows == 0){
	echo "<p class='alert alert-info'>No unassigned users at the moment.</p>";
}else{
?>
<form method="post" action="cases.php" class="form-inline" style="margin-bottom:20px;">
	<div class="form-group">
		<label>User</label>
		<select class="form-control" name="user_id" required>
			<?php while($u=$uq->fetch_assoc()){
				echo "<option value='".$u['id']."'>".$u['name']." - ".$u['problem_category']."</option>";
			} ?>
		</select>
	</div>
	<div class="form-group"><label> NGO</label><select class="form-control" name="ngo_id" required><?php echo options($db,'NGO'); ?></select></div>
	<div class="form-group"><label> Team</label><select class="form-control" name="team_member_id" required><?php echo options($db,'team_member'); ?></select></div>
	<div class="form-group"><label> Counselor</label><select class="form-control" name="counselor_id" required><?php echo options($db,'counselor'); ?></select></div>
	<div class="form-group"><label> Category</label><input class="form-control" type="text" name="category" placeholder="e.g. Psychological Support" required></div>
	<button type="submit" name="assign_submit" class="btn btn-success">Connect</button>
</form>
<?php } ?>

<hr>
<h4>All Cases</h4>
<table class="table table-bordered table-responsive">
<thead>
<tr><th>#</th><th>User</th><th>Category</th><th>NGO</th><th>Team Member</th><th>Counselor</th><th>Progress</th><th>Rehab</th><th>Action</th></tr>
</thead>
<tbody>
<?php
$cq = $db->query("
	SELECT c.*, u.name AS uname,
	       n.name AS nname, n.ngo_name AS nngo,
	       t.name AS tname, co.name AS coname
	FROM cases c
	LEFT JOIN users u  ON c.user_id=u.id
	LEFT JOIN users n  ON c.ngo_id=n.id
	LEFT JOIN users t  ON c.team_member_id=t.id
	LEFT JOIN users co ON c.counselor_id=co.id
	ORDER BY c.id DESC");
$counter=0;
while($c=$cq->fetch_assoc()){
	$counter++;
	$ngoLabel = ($c['nngo']!='') ? $c['nngo'] : $c['nname'];
?>
<tr>
	<td><?php echo $counter; ?></td>
	<td><?php echo $c['uname']; ?></td>
	<td><?php echo $c['category']; ?></td>
	<td><?php echo $ngoLabel; ?></td>
	<td><?php echo $c['tname']; ?></td>
	<td><?php echo $c['coname']; ?></td>
	<td><b><?php echo $c['progress']; ?></b></td>
	<td><?php echo $c['in_rehab']; ?></td>
	<td>
		<a class="btn btn-warning btn-sm" href="cases.php?edit=<?php echo $c['id']; ?>">Edit</a>
		<a class="btn btn-danger btn-sm" href="cases.php?del=<?php echo $c['id']; ?>" onclick="return confirm('Delete case?')">Delete</a>
	</td>
</tr>
<?php } if($counter==0){ echo "<tr><td colspan='9'>No cases yet.</td></tr>"; } ?>
</tbody>
</table>

<?php
/* ---- Edit case ---- */
if(isset($_GET['edit'])){
	$cid=(int)$_GET['edit'];
	$er=$db->query("SELECT * FROM cases WHERE id='{$cid}'");
	$c=$er->fetch_assoc();
?>
<hr>
<h4>Edit Case #<?php echo $cid; ?></h4>
<form method="post" action="cases.php">
	<input type="hidden" name="case_id" value="<?php echo $cid; ?>">
	<div class="form-group"><label>NGO</label><select class="form-control" name="ngo_id"><?php echo options($db,'NGO',$c['ngo_id']); ?></select></div>
	<div class="form-group"><label>Team Member</label><select class="form-control" name="team_member_id"><?php echo options($db,'team_member',$c['team_member_id']); ?></select></div>
	<div class="form-group"><label>Counselor</label><select class="form-control" name="counselor_id"><?php echo options($db,'counselor',$c['counselor_id']); ?></select></div>
	<div class="form-group"><label>Progress</label>
		<select class="form-control" name="progress">
			<?php
			$stages=array('New','Assigned','Counseling','Skill Development','Rehabilitation','Closed');
			foreach($stages as $s){ $sel=($c['progress']==$s)?'selected':''; echo "<option $sel>$s</option>"; }
			?>
		</select>
	</div>
	<button type="submit" name="update_submit" class="btn btn-primary">Update Case</button>
	<a href="cases.php" class="btn btn-default">Cancel</a>
</form>
<?php } ?>

</div>
</div>
<div class="clearfix"> </div>
</div>
</div>
</div>

<?php } else { header("Location: logout.php"); exit; } ?>
<?php include_once "footer.php"; ?>
