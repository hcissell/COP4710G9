<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Delete An Individual</title>
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

					$individual = getIndividual($dbh, $id);
					if(!empty($individual)) {
						deleteIndividual($dbh, $individual);

					echo $individual['FirstName'] . " " . $individual['LastName'] . 
						 " Deleted Successfully!";
					
					} else {
						echo "Individual not found";
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