<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Create A Parish</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<div class="container">
		<?php include('../common/nav.php'); ?>
		<?php if($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
			<?php 
				$addressId = createAddress($dbh,
										   $_POST['addressline1'], 
										   $_POST['addressline2'], 
										   $_POST['city'],
										   $_POST['state'],
										   $_POST['zipcode']);

				$res = createParish($dbh,
									$_POST['parish'],
									$_POST['diocese'],
									$addressId);

				print($res);
				print_r($dbh->errorInfo());

			?>
		<?php endif; ?>
			<div class="row menu-header">
				<h4 class="span12" style="text-align:center;">Create A Parish</h4>
			</div>
		<form method="POST">
			<div class="basic-individual-info">
				<div class="row">
					<div class="span4">Parish Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="parish">
					</div>
				</div>
				<div class="row">
					<div class="span4">Diocese Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="diocese">
					</div>
				</div>
			</div>
			<div class="address-info">
				<div class="row">
					<div class="span4">Address Line 1:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="addressline1">
					</div>
				</div>
				<div class="row">
					<div class="span4">Address Line 2:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="addressline2">
					</div>
				</div>
				<div class="row">
					<div class="span4">City:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="city">
					</div>
				</div>
				<div class="row">
					<div class="span4">State:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="state">
					</div>
				</div>
				<div class="row">
					<div class="span4">Zip Code:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="zipcode">
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Create Parish">
		</form>
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</body>
</html>