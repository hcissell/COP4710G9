<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Create A Talk</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<div class="container">
		<?php include('../common/nav.php'); ?>
		<?php if($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
			<?php 
				$res = createTalk($dbh,
							      $_POST['title'], 
							      "b'1'",$_POST['description']);

				if($res) {
					print("Created talk " . $_POST['title'] . " Successfully!");
				} else {
					print("Error creating talk");
					print_r($dbh->errorInfo());
				}
			?>
		<?php endif; ?>
		<form method="POST">
			<div class="basic-individual-info">
				<div class="row">
					<div class="span4">Talk Title:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="title">
					</div>
				</div>
        <div class="row">
					<div class="span4">Description</div>
					<div class="span8">
						<textarea class="span8 form-control"
								  rows="5" name="description"></textarea>
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Create Talk">
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