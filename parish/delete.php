<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Delete A Parish</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php
					$id = $_GET['id'];
					if(empty($id)) {
						die("Must provide an id to delete!");
					}

					$parish = getParish($dbh, $id);
					if(!empty($parish)) {
						if(deleteParish($dbh, $parish)) {
							echo $parish['ParishName'] . " Deleted Successfully!";
						} else {
							echo "Error Deleting Parish";
						}
					
					} else {
						echo "Parish not found";
					}
				?>
			</div>
		</div>
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<?php include('../common/footer.php'); ?>
</html>