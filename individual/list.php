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
		$params = array();
		$extraParams = array();

		if(isset($_GET['gender']) && !empty($_GET['gender'])) {
			$params['Gender'] = $_GET['gender'];
		}
		if(isset($_GET['type']) && !empty($_GET['type'])) {
			$params['IndividualType'] = $_GET['type'];
		}
	
		if(isset($_GET['hasattended']) && !empty($_GET['hasattended'])) {
			$extraParams['attendence'] = $_GET['hasattended'];
		}

		if(isset($_GET['registeredforfuture']) && !empty($_GET['registeredforfuture'])) {
			$extraParams['futureAttendence'] = $_GET['registeredforfuture'];
		}
	
		$individuals = searchIndividuals($dbh, $params, $extraParams);
	?>

	
	<div class="container">
		<?php include('../common/nav.php'); ?>
		<div class="row menu-header">
			<h4 class="span12" style="text-align:center;">Cursillista List</h4>
		</div>
		<form class="row">
			<h5>Filter</h5>
			<table class="table">
				<thead>
					<tr>
						<th>Gender</th>
						<th>Team Member?</th>
						<th>Past Attendance</th>
						<th>Registered For Future</th>
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
							<select class="selectpicker" name="type">
								<option value=""></option>
								<option value="TEAM">Yes</option>
								<option value="CANDIDATE">No</option>
							</select>
						</td>
						<td>
							<select class="selectpicker" name="hasattended">
								<option value=""></option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</td>
						<td>
							<select class="selectpicker" name="registeredforfuture">
								<option value=""></option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
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
			<h4>Cursillistas</h4>
			<table class="table table-striped">
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
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<?php include('../common/footer.php'); ?>
</html>
