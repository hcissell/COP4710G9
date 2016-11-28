<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cursillo Registration</title>
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
							<a href="registration.php?cursillo=<?php echo $weekend['EventID']; ?>" target="new">
								<button type="button" class="btn btn-success">Select</button>
							</a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		<?php else: ?>
			<?php
				$id = $_GET['cursillo'];
				$weekend = getCursillo($dbh, $id);
				if(isset($_GET['addperson'])) {
					$individualID = $_GET['addperson'];
					if(!addAttendee($dbh, $individualID, $id)) {
						print("Error adding individual to cursillo");
					}
				}
				
				$individuals = getPotentialCandidates($dbh, $weekend['Gender'], $id);
			?>
			
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Name Tag</th>
						<th>Phone Number</th>
						<th>Parish</th>
						<th>Select</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($individuals as $individual): ?>
					<tr>
						<td><?php echo $individual['FirstName'] . " " . 
									   $individual['LastName'] ?>			   
						</td>
						<td><?php echo $individual['NameTag'] ?></td>
						<td><?php echo $individual['Phone'] ?></td>
						<td><?php echo $individual['ParishName'] ?></td>
						<td>
							<?php 
								$link = "cursillo=" . $id . "&" . 
										"addperson=" . $individual['IndividualID'];
							?>
							<a href="registration.php?<?php echo $link; ?>" target="new">
								<button type="button" class="btn btn-success">Select</button>
							</a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>

		<?php endif; ?>
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>