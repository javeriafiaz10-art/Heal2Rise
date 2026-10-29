<?php include_once "header.php"; ?>

<div id="wrapper">

<?php if($user_role == 'counselor'){ include_once "counselor_sidebar.php"; ?>

<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">
<div class="content-top">

<div class="col-md-4">
    <div class="content-top-1"><p class="alert">Update Your Info</p></div>
</div>

<div class="col-md-8">
    <div class="content-top-1">

        <?php
        $sql = "SELECT * FROM users WHERE id = '{$user_id}'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['name']; $email = $row['email'];
        $password = $row['password']; $phone = $row['contact'];
        $spec = $row['specialization'];
        ?>

        <form class="form-horizontal" action="" method="post">
            <div class="form-group"><input type="text" name="username" placeholder="Your Name" value="<?= $name ?>" class="form-control" required></div>
            <div class="form-group"><input type="email" name="email" placeholder="Your Email" class="form-control" value="<?= $email ?>" required></div>
            <div class="form-group"><input type="password" name="password" placeholder="Your Password" class="form-control" value="<?= $password ?>" required></div>
            <div class="form-group"><input type="text" name="phone" placeholder="Your Number" class="form-control" value="<?= $phone ?>" required></div>
            <div class="form-group"><input type="text" name="specialization" placeholder="Specialization" class="form-control" value="<?= $spec ?>"></div>
            <div class="form-group"><button type="submit" name="update" class="btn btn-info">Update</button></div>
        </form>

        <?php
        if (isset($_POST['update'])) {
            $username = $db->real_escape_string($_POST['username']);
            $email    = $db->real_escape_string($_POST['email']);
            $password = $db->real_escape_string($_POST['password']);
            $phone    = $db->real_escape_string($_POST['phone']);
            $spec     = $db->real_escape_string($_POST['specialization']);
            $u = "UPDATE users SET name='$username', email='$email', password='$password', contact='$phone', specialization='$spec' WHERE id='$user_id'";
            if($db->query($u)) {
                echo "<script>alert('Profile Info is Updated');window.open('index.php','_self');</script>";
            } else { echo "<div class='alert alert-danger'>".$db->error."</div>"; }
        }
        ?>

    </div>
</div>

<div class="clearfix"></div>
</div>
</div>
</div>

<?php } else { header("Location: logout.php"); } ?>

<?php include_once "footer.php"; ?>
