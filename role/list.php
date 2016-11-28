<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>role List</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>

	<div class="container">
		<?php include('../common/nav.php'); ?>
		<?php
			$roles = getRoles($dbh);
			$test = array('a' => 1);
		?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Role Name</th>
					<th>Is Active</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($roles as $role): ?>
				<tr>
					<td><?php echo $role['RoleName'] ?></td>
					<td><?php echo $role['IsActive'] ? "Yes" : "No" ?></td>
					<td>
						<a href="update.php?id=<?php echo $role['RoleID']; ?>" target="new">
							<button type="button" class="btn btn-success">Edit</button>
						</a>
					</td>
					<td>
						<a href="delete.php?id=<?php echo $role['RoleID']; ?>" target="new">
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