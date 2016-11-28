<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Build A Team</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>

	<div class="container">
		<?php include('../common/nav.php'); ?>
		<?php if(!isset($_GET['cursillo'])): ?>
			<?php
				$after = date('Y-m-d', time());
				$weekends = searchWeekends($dbh, $after);
			?>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>Number</th>
						<th>Title</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Gender</th>
						<th>Select</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($weekends as $weekend): ?>
					<?php 
						$start = new DateTime($weekend['Start']);
						$end = new DateTime($weekend['End']);
					?>

					<tr>
						<td><?php echo $weekend['EventID'] ?></td>
						<td><?php echo $weekend['EventName'] ?></td>
						<td><?php echo $start->format('Y-m-d') ?></td>
						<td><?php echo $end->format('Y-m-d') ?></td>
						<td><?php echo $weekend['Gender'] ?></td>
						<td>
							<a href="build.php?cursillo=<?php echo $weekend['EventID']; ?>" target="new">
								<button type="button" class="btn btn-success">Select</button>
							</a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		<?php else: ?>
			<div class="row">
				<?php
					$id = $_GET['cursillo'];

					if($_SERVER['REQUEST_METHOD'] === 'POST') {
						if(!createRoleAssignment($dbh, 
												 $_POST['individualid'],
												 $_POST['roleid'],
												 $id));
					} elseif(isset($_GET['delperson'])) {
						deleteRoleAssignment($dbh, 
											 $_GET['delperson'],
											 $_GET['roleid'],
											 $id);
					}

					$weekend = getCursillo($dbh, $id);
					
					$unassignedRoles = getUnassignedRoles($dbh, $id);
					$individuals = getPotentialTeamMembers($dbh, $weekend['Gender'], $id);
					$roleAssignments = getRoleAssignments($dbh, $id);
				?>
				<div class="span5">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Role Name</th>
								<th>Assigned To</th>
								<th>Unassign</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($roleAssignments as $role): ?>
							<tr>
								<td><?php echo $role['RoleName'] ?></td>
								<td><?php echo $role['FirstName'] ." ".
											   $role['LastName'] ?></td>
								<td>
									<?php 
										$link = "cursillo=" . $id . "&" . 
												"delperson=" . $role['TeamMemberID'] . "&" .
												"roleid=" . $role['RoleID'];
									?>
									<a href="build.php?<?php echo $link; ?>" target="new">
										<button type="button" class="btn btn-success">Unassign</button>
									</a>
								</td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="span7">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Phone Number</th>
								<th>Parish</th>
								<th>Role</th>
								<th>Assign</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($individuals as $individual): ?>
							<tr>
							<form method="POST">
								<td><?php echo $individual['FirstName'] . " " . 
											   $individual['LastName'] ?>			   
								</td>
								<td><?php echo $individual['Phone'] ?></td>
								<td><?php echo $individual['ParishName'] ?></td>
								<td>
									<select class="selectpicker" name="roleid">
									<?php foreach ($unassignedRoles as $role): ?>
										<option value="<?php echo $role['RoleID']; ?>">
											<?php echo $role['RoleName']; ?>
										</option>
									<?php endforeach; ?>
									</select>
								</td>

								<td>
									<input type="hidden" name="individualid"
											value="<?php echo $individual['IndividualID'];?>">
									<input class="btn btn-success" 
										   type="submit" value="Assign">
								</td>
							</form>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>

		<?php endif; ?>
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>