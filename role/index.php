<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cursillo</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<div class="container">
			<?php include('../common/nav.php'); ?>
			<div class="row menu-header">
				<h2 class="span12" style="text-align:center;">Role Menu</h2>
			</div>
			<div class="menu">
				<div class="row">
					<a href="add.php">
						<button type="button" class="btn span12">Create New Role</button>
					</a>
				</div>
				<div class="row">
					<a href="list.php">
						<button type="button" class="btn span12">List Roles</button>
					</a>
				</div>
			</div>
		</div>
	</body>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
	 		$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</html>