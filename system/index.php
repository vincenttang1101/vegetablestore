<?php
session_start();
if (isset($_POST['Login'])) {
	require_once($_SERVER['DOCUMENT_ROOT'] . '/vegetablestore/class/staff.php');
	$classStaff = new staff();
	$Username = $_POST['Username'];
	$Password = md5($_POST['Password']);
	$result = $classStaff->getByUser($Username);
	if ($result) {
		foreach ($result as $Account) {
			if ($Password == $Account['Password'] && $Account['Role'] == "Admin") {
				$_SESSION['StaffID']   = $Account['StaffID'];
				$_SESSION['StaffName'] = $Account['StaffName'];
				$_SESSION['Role']      = $Account['Role'];
				header("location: ../admin/index.php");
			} else if ($Password == $Account['Password'] && $Account['Role'] == "Manager") {
				$_SESSION['StaffID']   = $Account['StaffID'];
				$_SESSION['StaffName'] = $Account['StaffName'];
				$_SESSION['Role']      = $Account['Role'];
				header("location: ../manager/index.php");
			} else if ($Password == $Account['Password'] && $Account['Role'] == "Member") {
				$_SESSION['StaffID']   = $Account['StaffID'];
				$_SESSION['StaffName'] = $Account['StaffName'];
				$_SESSION['Role']      = $Account['Role'];
				header("location: ../member/index.php");
			} else echo "<script>alert('Invalid Password')</script>";
		}
	} else echo "<script>alert('Invalid Username')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title">
						System Login
					</span>

					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<input class="input100" type="text" name="Username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="Password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="Login">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Password
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Contact
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>