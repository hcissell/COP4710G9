<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Individual List</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<?php
		$individuals = getIndividuals($dbh);
	?>

	<div class="container">
	<?php include('../common/nav.php'); ?>
		<table>
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Name Tag</th>
					<th>Gender</th>
					<th>Type</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($individuals as $individual): ?>
				<tr>
					<td><?php echo $individual['FirstName'] ?></td>
					<td><?php echo $individual['LastName'] ?></td>
					<td><?php echo $individual['NameTag'] ?></td>
					<td><?php echo $individual['Gender'] ?></td>
					<td><?php echo $individual['IndividualType']?></td>
					<td>
						<a href="update.php?id=<?php echo $individual['IndividualID']; ?>" target="new">
							<button type="button" class="btn btn-success">Edit</button>
						</a>
					</td>
					<td>
						<a href="delete.php?id=<?php echo $individual['IndividualID']; ?>" target="new">
							<button type="button" class="btn btn-danger">Delete</button>
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