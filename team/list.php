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
		$role = null;
		$params = array();
		$extraParams = array();

		if(isset($_GET['gender']) && !empty($_GET['gender'])) {
			$params['Gender'] = $_GET['gender'];
		}

		if(isset($_GET['role']) && !empty($_GET['role'])) {
			$extraParams['role'] = $_GET['role'];
		}

		$params['IndividualType'] = 'TEAM';

		$individuals = searchIndividuals($dbh, $params, $extraParams);
		$roles = getRoles($dbh);
	?>

	<div class="container">
		<?php include('../common/nav.php'); ?>
		<div class="row menu-header">
			<h4 class="span12" style="text-align:center;">Team Member List</h4>
		</div>
		<form class="row">
			<h5>Filter</h5>
			<table class="table">
				<thead>
					<tr>
						<th>Gender</th>
						<th>Past Role Assignment</th>
						<th>Submit</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<select class="selectpicker" name="gender">
								<option value=""></option>
								<option value="MALE">Male</option>
								<option value="FEMALE">Female</option>
							</select>
						</td>
						<td>
							<select class="selectpicker" name="role">
								<option value=""></option>
							<?php foreach ($roles as $role): ?>
								<option value="<?php echo $role['RoleID']?>">
									<?php echo $role['RoleName']?>
								</option>
							<?php endforeach; ?>
							</select>
						</td>
						<td>
							<input class="btn btn-primary" type="submit" value="filter">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<div class="row">
			<table class="table table-striped">
				<h4>Cursillista Team Members</h4>
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
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
