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
				<h2 class="span12" style="text-align:center;">Cursillo Menu</h2>
			</div>
			<div class="menu">
				<div class="row">
					<a href="add.php">
						<button type="button" class="btn span12">Create a new Weekend</button>
					</a>
				</div>
				<div class="row">
					<a href="list.php">
						<button type="button" class="btn span12">Weekend List</button>
					</a>
				</div>
				<div class="row">
					<a href="registration.php">
						<button type="button" class="btn span12">Register Candidates</button>
					</a>
				</div>
				<div class="row">
					<a href="registered.php">
						<button type="button" class="btn span12">List Candidate Registrations</button>
					</a>
				</div>
			</div>
		</div>
	</body>
<?php include('../common/footer.php'); ?>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
	 		$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</html>