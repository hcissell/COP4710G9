<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	include('../common/util.php');
	$dbh = connectToDB();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Team Members</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<?php
		$params = array();
		if(isset($_GET['gender'])) {
			$params['Gender'] = $_GET['gender'];
		}

		$params['IndividualType'] = 'TEAM';

		$individuals = searchIndividuals($dbh, $params);
	?>

	
	<div class="container">
		<?php include('../common/nav.php'); ?>
		<table class="table table-striped">

			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($individuals as $individual): ?>
				<tr>
					<td><?php echo $individual['FirstName'] ?></td>
					<td><?php echo $individual['LastName'] ?></td>
					<td><?php echo $individual['Gender'] ?></td>
					<td>
						<a href="update.php?id=<?php echo $individual['IndividualID']; ?>" target="new">
							<button type="button" class="btn btn-success">Edit</button>
						</a>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
