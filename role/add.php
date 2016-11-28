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
				$res = createRole($dbh,
							      $_POST['rolename'], 
							      "b'1'");

				if($res) {
					print("Created role " . $_POST['rolename'] . " Successfully!");
				} else {
					print("Error creating role");
					print_r($dbh->errorInfo());
				}
			?>
		<?php endif; ?>
		<form method="POST">
			<div class="basic-individual-info">
				<div class="row">
					<div class="span4">Role Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="rolename">
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Create Role">
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